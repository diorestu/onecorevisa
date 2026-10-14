const menuToggle = document.querySelector('.menu-toggle');
const menu = document.querySelector('#mobile-nav');
const dialog = document.querySelector('#consultation-dialog');
const form = document.querySelector('#consultation-form');
const serviceSelect = document.querySelector('#service');
let returnFocus;

function closeMenu() {
    menu.hidden = true;
    menuToggle.setAttribute('aria-expanded', 'false');
}
menuToggle.addEventListener('click', () => {
    const expanded = menuToggle.getAttribute('aria-expanded') === 'true';
    menu.hidden = expanded;
    menuToggle.setAttribute('aria-expanded', String(!expanded));
});
menu.querySelectorAll('a').forEach(link => link.addEventListener('click', closeMenu));
document.addEventListener('keydown', event => {
    if (event.key === 'Escape' && !menu.hidden) { closeMenu(); menuToggle.focus(); }
});
window.matchMedia('(min-width: 1101px)').addEventListener('change', event => { if (event.matches) closeMenu(); });
document.querySelectorAll('[data-consultation]').forEach(button => {
    button.addEventListener('click', () => {
        returnFocus = menu.contains(button) ? menuToggle : button;
        const service = button.dataset.consultation;
        serviceSelect.value = Array.from(serviceSelect.options).some(option => option.value === service) ? service : 'General Consultation';
        closeMenu();
        dialog.showModal();
        document.querySelector('#name').focus();
    });
});
dialog.querySelectorAll('.dialog-close, .dialog-cancel').forEach(button => button.addEventListener('click', () => dialog.close()));
dialog.addEventListener('click', event => {
    const bounds = dialog.getBoundingClientRect();
    if (event.target === dialog && (event.clientX < bounds.left || event.clientX > bounds.right || event.clientY < bounds.top || event.clientY > bounds.bottom)) dialog.close();
});
dialog.addEventListener('close', () => {
    const card = returnFocus?.closest('.service-item');
    if (card) expandServiceCard(card, true);
    returnFocus?.focus();
});
form.addEventListener('submit', () => {
    const submit = form.querySelector('[type="submit"]');
    submit.dataset.originalLabel = submit.textContent;
    submit.textContent = submit.dataset.loadingLabel;
    submit.disabled = true;
    form.setAttribute('aria-busy', 'true');
});
window.addEventListener('pageshow', () => {
    const submit = form.querySelector('[type="submit"]');
    if (submit.dataset.originalLabel) submit.textContent = submit.dataset.originalLabel;
    submit.disabled = false;
    form.removeAttribute('aria-busy');
});

const preferenceForm = document.querySelector('#preference-form');
if (preferenceForm) {
    const countryInput = document.querySelector('#preference-country');
    const preferenceService = document.querySelector('#preference-service');
    const preferenceResult = document.querySelector('#preference-result');
    const countryCodes = 'AD AE AF AG AI AL AM AO AQ AR AS AT AU AW AX AZ BA BB BD BE BF BG BH BI BJ BL BM BN BO BQ BR BS BT BV BW BY BZ CA CC CD CF CG CH CI CK CL CM CN CO CR CU CV CW CX CY CZ DE DJ DK DM DO DZ EC EE EG EH ER ES ET FI FJ FK FM FO FR GA GB GD GE GF GG GH GI GL GM GN GP GQ GR GS GT GU GW GY HK HM HN HR HT HU ID IE IL IM IN IO IQ IR IS IT JE JM JO JP KE KG KH KI KM KN KP KR KW KY KZ LA LB LC LI LK LR LS LT LU LV LY MA MC MD ME MF MG MH MK ML MM MN MO MP MQ MR MS MT MU MV MW MX MY MZ NA NC NE NF NG NI NL NO NP NR NU NZ OM PA PE PF PG PH PK PL PM PN PR PS PT PW PY QA RE RO RS RU RW SA SB SC SD SE SG SH SI SJ SK SL SM SN SO SR SS ST SV SX SY SZ TC TD TF TG TH TJ TK TL TM TN TO TR TT TV TW TZ UA UG UM US UY UZ VA VC VE VG VI VN VU WF WS YE YT ZA ZM ZW'.split(' ');
    const countryNames = new Intl.DisplayNames([document.documentElement.lang], { type: 'region' });
    const countryOptions = countryCodes.map(code => ({
        name: countryNames.of(code),
        flag: String.fromCodePoint(...[...code].map(letter => 127397 + letter.charCodeAt(0))),
    })).sort((a, b) => a.name.localeCompare(b.name, document.documentElement.lang));
    const countries = countryOptions.map(country => country.name);
    const countryFlags = new Map(countryOptions.map(country => [country.name, country.flag]));
    countryOptions.forEach(country => {
        const option = document.createElement('option');
        option.value = country.name;
        option.textContent = `${country.flag} ${country.name}`;
        countryInput.append(option);
    });
    function renderCountry(data, escape) {
        const flag = countryFlags.get(data.value) || '';
        return `<div class="country-option"><span class="country-flag" aria-hidden="true">${escape(flag)}</span><span class="country-name">${escape(data.value || data.text)}</span></div>`;
    }
    const noResults = document.documentElement.lang === 'id' ? 'Tidak ada pilihan yang cocok.' : 'No matching options.';
    if (window.TomSelect) {
        [countryInput, preferenceService].forEach(input => {
            input.multiple = false;
            new TomSelect(input, {
                create: false,
                mode: 'single',
                maxItems: 1,
                maxOptions: null,
                searchField: ['text'],
                refreshThrottle: 0,
                closeAfterSelect: true,
                lockOptgroupOrder: true,
                placeholder: input.dataset.placeholder || input.options[0].textContent,
                render: {
                    ...(input === countryInput ? { option: renderCountry, item: renderCountry } : {}),
                    no_results: (_data, escape) => `<div class="no-results">${escape(noResults)}</div>`,
                },
                onType(query) {
                    this.wrapper.classList.toggle('is-searching', query.length > 0);
                },
                onDropdownClose() {
                    this.wrapper.classList.remove('is-searching');
                },
                onInitialize() {
                    input.setAttribute('aria-hidden', 'true');
                    this.control_input.setAttribute('aria-describedby', input.getAttribute('aria-describedby'));
                    this.control_input.setAttribute('aria-required', 'true');
                },
            });
        });
    }
    let selectedPreference;
    function setPreferenceError(input, helperId, invalid) {
        const helper = document.querySelector(helperId);
        input.setAttribute('aria-invalid', String(invalid));
        input.tomselect?.control_input.setAttribute('aria-invalid', String(invalid));
        input.tomselect?.wrapper.classList.toggle('is-invalid', invalid);
        helper.textContent = invalid ? helper.dataset.error : helper.dataset.default;
        helper.classList.toggle('error', invalid);
    }
    function clearPreference() {
        preferenceResult.hidden = true;
        selectedPreference = undefined;
    }
    countryInput.addEventListener('change', () => {
        clearPreference();
        setPreferenceError(countryInput, '#country-help', false);
    });
    preferenceService.addEventListener('change', () => {
        clearPreference();
        setPreferenceError(preferenceService, '#service-help', false);
    });
    preferenceForm.addEventListener('submit', event => {
        event.preventDefault();
        const country = countries.find(name => name.toLocaleLowerCase() === countryInput.value.trim().toLocaleLowerCase());
        const service = preferenceService.value;
        setPreferenceError(countryInput, '#country-help', !country);
        setPreferenceError(preferenceService, '#service-help', !service);
        if (!country || !service) {
            clearPreference();
            const invalidInput = !country ? countryInput : preferenceService;
            if (invalidInput.tomselect) invalidInput.tomselect.focus();
            else invalidInput.focus();
            return;
        }
        countryInput.value = country;
        selectedPreference = { country, service };
        document.querySelector('#result-country').textContent = country;
        document.querySelector('#result-service').textContent = preferenceService.selectedOptions[0].textContent;
        preferenceResult.hidden = false;
        document.querySelector('#preference-continue').click();
    });
    document.querySelector('#preference-continue').addEventListener('click', event => {
        if (!selectedPreference) return;
        returnFocus = event.currentTarget;
        serviceSelect.value = selectedPreference.service;
        document.querySelector('#nationality').value = selectedPreference.country;
        dialog.showModal();
        document.querySelector('#name').focus();
    });

}

const serviceCards = document.querySelectorAll('.service-item');
function expandServiceCard(card, expanded) {
    card.dataset.expanded = String(expanded);
    card.querySelector('.service-toggle').setAttribute('aria-expanded', String(expanded));
    const details = card.querySelector('.service-card-details');
    details.inert = !expanded;
    details.setAttribute('aria-hidden', String(!expanded));
}
function measureServiceCards() {
    serviceCards.forEach(card => {
        const details = card.querySelector('.service-card-details');
        details.hidden = false;
        card.style.setProperty('--service-detail-height', `${details.getBoundingClientRect().height}px`);
    });
}
measureServiceCards();
document.fonts.ready.then(measureServiceCards);
window.addEventListener('resize', measureServiceCards);
serviceCards.forEach(card => {
    card.addEventListener('pointerenter', event => {
        if (event.pointerType === 'mouse') expandServiceCard(card, true);
    });
    card.addEventListener('pointerleave', event => {
        if (event.pointerType === 'mouse' && !card.contains(document.activeElement)) expandServiceCard(card, false);
    });
    card.addEventListener('focusin', event => {
        if (event.target.matches(':focus-visible')) expandServiceCard(card, true);
    });
    card.addEventListener('focusout', event => {
        if (!card.contains(event.relatedTarget) && !card.matches(':hover')) expandServiceCard(card, false);
    });
    card.addEventListener('click', event => {
        if (event.target.closest('[data-consultation], .service-learn-more')) return;
        const expanded = event.pointerType === 'mouse' || card.dataset.expanded !== 'true';
        serviceCards.forEach(other => { if (other !== card) expandServiceCard(other, false); });
        expandServiceCard(card, expanded);
    });
});

const siteHeader = document.querySelector('.site-header');
let headerUpdatePending = false;
function updateHeaderSurface() {
    siteHeader.classList.toggle('is-solid', !document.querySelector('#hero') || window.scrollY > 0);
    headerUpdatePending = false;
}
function requestHeaderUpdate() {
    if (headerUpdatePending) return;
    headerUpdatePending = true;
    requestAnimationFrame(updateHeaderSurface);
}
window.addEventListener('scroll', requestHeaderUpdate, { passive: true });
window.addEventListener('resize', requestHeaderUpdate);
window.addEventListener('pageshow', requestHeaderUpdate);
updateHeaderSurface();

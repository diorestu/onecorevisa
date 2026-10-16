const simulator = document.querySelector('#visa-simulator');

if (simulator) {
    const list = simulator.querySelector('#simulator-countries');
    const search = simulator.querySelector('#simulator-search');
    const purpose = simulator.querySelector('#simulator-purpose');
    const stay = simulator.querySelector('#simulator-stay');
    const regionNames = new Intl.DisplayNames([document.documentElement.lang], { type: 'region' });
    const englishNames = new Intl.DisplayNames(['en'], { type: 'region' });
    const countries = JSON.parse(simulator.dataset.countries).map(code => ({
        code,
        name: regionNames.of(code),
        englishName: englishNames.of(code),
    })).sort((a, b) => a.name.localeCompare(b.name, document.documentElement.lang));
    const options = [...simulator.querySelectorAll('.simulator-option')];
    let selectedCountry;

    const normalize = value => value.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLocaleLowerCase();

    function createFlag(country, selected = false) {
        const flag = document.createElement('img');
        flag.src = `${simulator.dataset.flagBase}${country.code.toLowerCase()}.svg`;
        flag.alt = '';
        flag.className = 'simulator-country-flag';
        flag.width = selected ? 72 : 32;
        flag.height = selected ? 54 : 24;
        flag.loading = selected ? 'eager' : 'lazy';
        flag.decoding = 'async';
        return flag;
    }

    function updateResults() {
        if (!selectedCountry) return;
        simulator.querySelector('#simulator-country-name').textContent = selectedCountry.name;
        simulator.querySelector('#simulator-country-code').replaceChildren(createFlag(selectedCountry, true));
        simulator.querySelector('#simulator-before-selection').hidden = true;
        simulator.querySelector('#simulator-results').hidden = false;
        let matches = 0;
        const countrySlug = normalize(selectedCountry.englishName).toUpperCase().replace(/[^A-Z0-9]+/g, '-').replace(/^-|-$/g, '');
        const purposeText = { all: 'Not specified', tourism: 'Tourism', remote: 'Remote work' }[purpose.value];
        const stayText = { any: 'Not specified', 30: '30 days or less', 60: 'Up to 60 days', 180: 'Up to 180 days', long: 'More than 180 days' }[stay.value];
        options.forEach(option => {
            const maxDays = Number(option.dataset.maxDays);
            const durationMatches = stay.value === 'any' || maxDays === 0 || (stay.value !== 'long' && Number(stay.value) <= maxDays);
            option.hidden = (purpose.value !== 'all' && option.dataset.purpose !== purpose.value) || !durationMatches;
            const message = [
                `[WA-${option.dataset.serviceCode}-${countrySlug}]`,
                '',
                'Hello OneCore team,',
                `I would like assistance with ${option.dataset.serviceName}.`,
                '',
                `Passport nationality: ${selectedCountry.englishName} (${selectedCountry.code})`,
                `Travel purpose: ${purposeText}`,
                `Planned length of stay: ${stayText}`,
                '',
                'Could you please confirm the requirements, fees, and estimated processing time?',
                'Thank you.',
            ].join('\n');
            option.querySelector('.simulator-whatsapp').href = `https://wa.me/6289672966845?text=${encodeURIComponent(message)}`;
            if (!option.hidden) matches++;
        });
        simulator.querySelector('#simulator-no-options').hidden = matches > 0;
        const status = simulator.querySelector('#simulator-result-status');
        status.textContent = `${status.dataset.label}: ${matches}`;
        list.querySelectorAll('button').forEach(button => {
            const selected = button.dataset.code === selectedCountry.code;
            button.setAttribute('aria-pressed', String(selected));
            button.tabIndex = selected ? 0 : -1;
        });
        if (![...list.querySelectorAll('button')].some(button => button.tabIndex === 0)) {
            const first = list.querySelector('button');
            if (first) first.tabIndex = 0;
        }
    }

    function renderCountries() {
        const query = normalize(search.value.trim());
        const filtered = countries.filter(country => normalize(`${country.name} ${country.englishName} ${country.code}`).includes(query));
        const fragment = document.createDocumentFragment();
        filtered.forEach((country, index) => {
            const item = document.createElement('li');
            const button = document.createElement('button');
            button.type = 'button';
            button.dataset.code = country.code;
            button.setAttribute('aria-pressed', String(selectedCountry?.code === country.code));
            button.tabIndex = selectedCountry?.code === country.code || (!selectedCountry && index === 0) ? 0 : -1;
            const name = document.createElement('span');
            name.textContent = country.name;
            button.append(createFlag(country), name);
            button.addEventListener('click', () => {
                selectedCountry = country;
                purpose.value = 'all';
                stay.value = 'any';
                updateResults();
            });
            item.append(button);
            fragment.append(item);
        });
        list.replaceChildren(fragment);
        const first = list.querySelector('button');
        if (first && !list.querySelector('[tabindex="0"]')) first.tabIndex = 0;
        simulator.querySelector('#simulator-country-count').textContent = `${simulator.dataset.resultCount}: ${filtered.length}`;
        simulator.querySelector('#simulator-no-countries').hidden = filtered.length > 0;
    }

    list.addEventListener('keydown', event => {
        if (!['ArrowDown', 'ArrowUp', 'Home', 'End'].includes(event.key)) return;
        const buttons = [...list.querySelectorAll('button')];
        if (!buttons.length) return;
        event.preventDefault();
        const current = buttons.indexOf(document.activeElement);
        const next = event.key === 'Home' ? 0 : event.key === 'End' ? buttons.length - 1
            : Math.max(0, Math.min(buttons.length - 1, current + (event.key === 'ArrowDown' ? 1 : -1)));
        buttons.forEach((button, index) => { button.tabIndex = index === next ? 0 : -1; });
        buttons[next].focus();
    });
    search.addEventListener('input', renderCountries);
    purpose.addEventListener('change', updateResults);
    stay.addEventListener('change', updateResults);
    renderCountries();

}

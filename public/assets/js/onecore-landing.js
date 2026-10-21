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
window.matchMedia('(min-width: 1280px)').addEventListener('change', event => { if (event.matches) closeMenu(); });
document.querySelectorAll('[data-consultation]').forEach(button => {
    button.addEventListener('click', () => {
        returnFocus = menu.contains(button) ? menuToggle : button;
        const service = button.dataset.consultation;
        serviceSelect.value = Array.from(serviceSelect.options).some(option => option.value === service) ? service : 'General Consultation';
        closeMenu();
        dialog.classList.toggle('visa-modal-motion', button.classList.contains('visa-item'));
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
new ResizeObserver(() => {
    document.documentElement.style.setProperty('--header-height', `${siteHeader.getBoundingClientRect().height}px`);
}).observe(siteHeader);
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

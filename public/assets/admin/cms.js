document.addEventListener('DOMContentLoaded', () => {
    let dirty = false;
    const editor = document.querySelector('[data-editor-form]');
    const category = editor?.querySelector('[name="category_id"]');
    const updateServiceFields = () => {
        if (editor?.dataset.module !== 'services') return;
        const legal = category?.selectedOptions[0]?.dataset.kind === 'legal';
        editor.querySelectorAll('[data-legal-field]').forEach(field => { field.hidden = !legal; });
    };
    category?.addEventListener('change', updateServiceFields);
    updateServiceFields();
    editor?.addEventListener('input', () => { dirty = true; });
    window.addEventListener('beforeunload', event => { if (dirty) { event.preventDefault(); event.returnValue = ''; } });
    document.addEventListener('click', event => {
        const add = event.target.closest('[data-add]');
        if (add) {
            const repeater = add.closest('[data-repeater]');
            const items = repeater.querySelector(':scope > [data-items]');
            const next = Number(repeater.dataset.next);
            repeater.dataset.next = String(next + 1);
            const source = repeater.querySelector(':scope > template').innerHTML;
            items.insertAdjacentHTML('beforeend', source.replaceAll(repeater.dataset.token, String(next)));
            items.lastElementChild.querySelector('input, textarea, select')?.focus();
            dirty = true;
        }
        const remove = event.target.closest('[data-remove]');
        if (remove) { const item = remove.closest('[data-item]'); const parent = item.parentElement; item.remove(); parent.parentElement.querySelector(':scope > [data-add]')?.focus(); dirty = true; }
        const format = event.target.closest('[data-format]');
        if (format) {
            const input = format.closest('[data-markdown]').querySelector('textarea');
            const before = input.selectionStart; const after = input.selectionEnd; const selected = input.value.slice(before, after) || 'teks';
            const formats = {bold: `**${selected}**`, italic: `*${selected}*`, heading: `\n## ${selected}\n`, list: `\n- ${selected}\n`, link: `[${selected}](https://)`};
            input.setRangeText(formats[format.dataset.format], before, after, 'select'); input.focus(); dirty = true;
        }
    });
    document.querySelectorAll('form').forEach(form => form.addEventListener('submit', event => {
        if (form.dataset.confirm && !confirm(form.dataset.confirm)) { event.preventDefault(); return; }
        dirty = false;
        const button = form.querySelector('[data-submit]');
        if (button) { button.disabled = true; button.textContent = 'Menyimpan…'; }
    }));
    window.addEventListener('pageshow', () => document.querySelectorAll('[data-submit]').forEach(button => { button.disabled = false; button.textContent = 'Simpan perubahan'; }));
});

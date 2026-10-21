<section class="visa-simulator container" id="visa-simulator" aria-labelledby="simulator-title" data-flag-base="{{ asset('assets/images/flags') }}/" data-countries='@json($visaSimulatorCountries)' data-result-count="{{ $t('Matching countries', 'Negara yang cocok') }}" data-country-label="{{ $t('Nationality', 'Kewarganegaraan') }}" data-purpose-label="{{ $t('Visa Category', 'Kategori Visa') }}" data-stay-label="{{ $t('Length of stay', 'Lama tinggal') }}">
    <div class="section-head simulator-heading"><div><p class="section-label">{{ $t('Plan your visit', 'Rencanakan kunjungan Anda') }}</p><h2 id="simulator-title">{{ $t('Find a starting point for your visa.', 'Temukan pilihan awal visa Anda.') }}</h2></div><p>{{ $t('Choose your passport nationality, visa category, and intended stay to explore relevant services.', 'Pilih kewarganegaraan paspor, kategori visa, dan lama tinggal untuk melihat layanan yang relevan.') }}</p></div>
    <div class="simulator-layout">
        <div class="simulator-country-panel">
            <label for="simulator-search">{{ $t('Search your country', 'Cari negara Anda') }}</label>
            <div class="simulator-search-wrap"><x-icon name="globe" /><input type="search" id="simulator-search" placeholder="{{ $t('Type a country name', 'Ketik nama negara') }}" autocomplete="off" aria-controls="simulator-countries" aria-describedby="simulator-country-count"></div>
            <p id="simulator-country-count" class="simulator-country-count" aria-live="polite"></p>
            <ul id="simulator-countries" class="simulator-country-list" aria-label="{{ $t('Passport nationality', 'Kewarganegaraan paspor') }}"></ul>
            <p id="simulator-no-countries" class="simulator-empty-search" hidden>{{ $t('No matching country in this list. Contact our team to discuss your nationality.', 'Negara tidak ditemukan dalam daftar ini. Hubungi tim kami untuk membahas kewarganegaraan Anda.') }}</p>
            <button type="button" class="simulator-country-help text-link" data-consultation="Help choosing a visa">{{ $t('My country is not listed', 'Negara saya tidak tercantum') }}</button>
        </div>
        <div class="simulator-result-panel">
            <div class="simulator-selection"><span id="simulator-country-code" class="simulator-country-code" aria-hidden="true">—</span><div><p class="section-label">{{ $t('Passport nationality', 'Kewarganegaraan paspor') }}</p><h3 id="simulator-country-name">{{ $t('Select your country', 'Pilih negara Anda') }}</h3></div></div>
            <div class="simulator-filters">
                <div class="field"><label for="simulator-purpose">{{ $t('Visa Category', 'Kategori Visa') }}</label><div class="select-wrap"><select id="simulator-purpose"><option value="all">{{ $t('All visa options', 'Semua pilihan visa') }}</option><option value="tourism">{{ $t('Tourism', 'Wisata') }}</option><option value="remote">{{ $t('Remote work', 'Kerja jarak jauh') }}</option></select></div></div>
                <div class="field"><label for="simulator-stay">{{ $t('Length of stay', 'Lama tinggal') }}</label><div class="select-wrap"><select id="simulator-stay"><option value="any">{{ $t('Not sure yet', 'Belum yakin') }}</option><option value="30">{{ $t('30 days or less', '30 hari atau kurang') }}</option><option value="60">{{ $t('Up to 60 days', 'Hingga 60 hari') }}</option><option value="180">{{ $t('Up to 180 days', 'Hingga 180 hari') }}</option><option value="long">{{ $t('More than 180 days', 'Lebih dari 180 hari') }}</option></select></div></div>
            </div>
            <div id="simulator-before-selection" class="simulator-before-selection"><x-icon name="passport" /><p>{{ $t('Select a nationality to see services for your travel plans.', 'Pilih kewarganegaraan untuk melihat layanan sesuai rencana perjalanan Anda.') }}</p></div>
            <div id="simulator-results" hidden>
                <p class="simulator-voa-note">{{ $t('This nationality appears on the published Visa on Arrival list. The service options below also depend on your travel purpose and documents.', 'Kewarganegaraan ini tercantum pada daftar Visa on Arrival yang dipublikasikan. Pilihan layanan berikut juga bergantung pada tujuan perjalanan dan dokumen Anda.') }}</p>
                <h4 class="simulator-options-title">{{ $t('Services to explore', 'Layanan untuk dipertimbangkan') }}</h4>
                <p id="simulator-result-status" class="simulator-country-count" role="status" data-label="{{ $t('Matching services', 'Layanan yang sesuai') }}"></p>
                <div class="simulator-options">
                    @foreach([
                        ['VOA', 'VOA', 'tourism', 60, ['VOA', 'VOA'], ['30-day initial stay, with one 30-day extension. For a visit of up to 60 days in total.', 'Masa tinggal awal 30 hari, dengan satu perpanjangan 30 hari. Untuk kunjungan hingga total 60 hari.']],
                        ['C1', 'C1 Tourist', 'tourism', 180, ['C1 Tourist', 'C1 Tourist'], ['60-day initial stay. Extensions may allow up to 180 days in total.', 'Masa tinggal awal 60 hari. Perpanjangan dapat memungkinkan hingga total 180 hari.']],
                        ['D1', 'D1 Tourist', 'tourism', 180, ['D1 Tourist', 'D1 Tourist'], ['For repeat tourist visits. Discuss the stay limit for each entry and available extensions with our team.', 'Untuk kunjungan wisata berulang. Diskusikan batas masa tinggal per kedatangan dan pilihan perpanjangan bersama tim kami.']],
                        ['DIGITAL-NOMAD', 'Digital Nomad', 'remote', 0, ['Digital Nomad', 'Digital Nomad'], ['Discuss your overseas employment and supporting documents with our team.', 'Diskusikan pekerjaan luar negeri dan dokumen pendukung Anda bersama tim kami.']],
                    ] as $option)
                    <article class="simulator-option" data-service-code="{{ $option[0] }}" data-service-name="{{ $option[1] }}" data-purpose="{{ $option[2] }}" data-max-days="{{ $option[3] }}" hidden><h5>{{ $t(...$option[4]) }}</h5><p>{{ $t(...$option[5]) }}</p><a class="button secondary simulator-whatsapp" href="https://wa.me/6289672966845" target="_blank" rel="noopener noreferrer"><x-icon name="whatsapp" />{{ $t('Chat with CS', 'Chat dengan CS') }}<span class="sr-only">: {{ $t(...$option[4]) }}</span></a></article>
                    @endforeach
                </div>
                <p id="simulator-no-options" class="simulator-no-options" hidden>{{ $t('Your plans need a closer review. Our team can discuss an appropriate stay permit and the next steps.', 'Rencana Anda perlu ditinjau lebih lanjut. Tim kami dapat mendiskusikan izin tinggal yang sesuai dan langkah berikutnya.') }}</p>
            </div>
            <p class="simulator-source">{{ $t('This is a planning tool, not an entry approval. Confirm current requirements before applying.', 'Ini alat perencanaan, bukan persetujuan masuk. Pastikan persyaratan terkini sebelum mengajukan.') }} <a href="{{ config('visa_simulator.source_url') }}" target="_blank" rel="noopener noreferrer">{{ $t('Official country list', 'Daftar negara resmi') }}</a></p>
        </div>
    </div>
    <noscript><p>{{ $t('Enable JavaScript to try the selection tool, or contact our team directly.', 'Aktifkan JavaScript untuk menggunakan alat ini, atau hubungi tim kami langsung.') }}</p></noscript>
</section>

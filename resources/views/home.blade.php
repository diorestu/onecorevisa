@extends('layouts.app')

@section('content')
@php
    $t = fn ($en, $id) => $lang === 'id' ? $id : $en;
    $landingServices = array_map(fn ($category) => [$category['name'], $category['title_id']], $serviceCategories);
    $visaTypes = [
        ['Tourism', 'Wisata', 'Holidays & visits', 'Liburan & kunjungan'],
        ['Business & Investment', 'Bisnis & Investasi', 'Your next business move', 'Langkah bisnis Anda berikutnya'],
        ['Work & Employment', 'Kerja & Ketenagakerjaan', 'Your career in Indonesia', 'Karier Anda di Indonesia'],
        ['Retirement', 'Pensiun', 'A new pace of life', 'Babak kehidupan yang baru'],
        ['Family Dependent', 'Keluarga', 'Stay together in Indonesia', 'Tinggal bersama keluarga'],
        ['Education & Training', 'Pendidikan & Pelatihan', 'Learning & development', 'Belajar & pengembangan diri'],
        ['Professional', 'Profesional', 'Professional activities', 'Kegiatan profesional'],
        ['Performer', 'Pelaku Pertunjukan', 'Arts & performances', 'Seni & pertunjukan'],
        ['Second Home', 'Second Home', 'Make Indonesia your base', 'Jadikan Indonesia tempat tinggal'],
        ['Golden Visa', 'Golden Visa', 'Explore long-term options', 'Pilihan tinggal jangka panjang'],
        ['Global Talent', 'Global Talent', 'Bring your expertise', 'Bawa keahlian Anda'],
        ['Ex-Indonesian Citizen', 'Eks Warga Negara Indonesia', 'Reconnect with Indonesia', 'Terhubung kembali dengan Indonesia'],
        ['Permanent Residency', 'Izin Tinggal Tetap', 'Plan for a longer future', 'Rencanakan masa depan di Indonesia'],
    ];
@endphp
<section class="hero" id="hero" aria-labelledby="hero-title">
<div class="container hero-content">
    <p class="hero-intro">One Step Solution</p>
    <h1 id="hero-title"><span>{{ $t('Your Trusted Partner', 'Mitra Tepercaya') }}</span> {{ $t('for Visa Assistance', 'untuk Pengurusan Visa Anda') }}</h1>
    <div class="hero-bottom">
        <p>{{ $t('Getting the right Indonesian visa starts with the right guidance. Sunset Visa Agency is a private consultancy helping individuals and businesses understand visa requirements with clear advice, transparent communication, and efficient support at every step.', 'Memilih visa Indonesia yang tepat dimulai dengan panduan yang tepat. Sunset Visa Agency adalah konsultan swasta yang membantu individu dan bisnis memahami persyaratan visa melalui arahan yang jelas, komunikasi transparan, dan pendampingan yang efisien di setiap tahap.') }}</p>
        <div class="hero-actions">
            <button class="button primary" type="button" data-consultation="General Consultation">{{ $t('Talk To Our Team', 'Konsultasi Dengan Kami') }}</button>
            <a class="text-link" href="#preference-section">{{ $t('Explore Visa Options', 'Lihat Pilihan Visa') }} <span aria-hidden="true">↓</span></a>
        </div>
    </div>

</div>
</section>

<section class="preference-section container" id="preference-section" aria-labelledby="preference-title">
    <div class="preference-inner">
        <div class="section-head preference-cta-head"><div><p class="section-label">{{ $t('Check your preference', 'Pilih kebutuhan Anda') }}</p><h2 id="preference-title">{{ $t('Ready for your next step?', 'Siap untuk langkah berikutnya?') }}</h2></div><p>{{ $t('Choose your nationality and service. Let’s start planning your stay in Indonesia.', 'Pilih kewarganegaraan dan layanan. Mari mulai merencanakan masa tinggal Anda di Indonesia.') }}</p></div>
        <form id="preference-form" class="preference-form" novalidate>
            <div class="field"><label for="preference-country">{{ $t('Country of nationality', 'Negara kewarganegaraan') }}</label><select id="preference-country" name="country" autocomplete="country-name" data-placeholder="{{ $t('Search Your Country', 'Cari Negara Anda') }}" required aria-describedby="country-help"><option value="">{{ $t('Search Your Country', 'Cari Negara Anda') }}</option></select><p id="country-help" class="preference-helper" data-default="{{ $t('Type to search, then choose your country.', 'Ketik untuk mencari, lalu pilih negara Anda.') }}" data-error="{{ $t('Choose a country from the list to continue.', 'Pilih negara dari daftar untuk melanjutkan.') }}">{{ $t('Type to search, then choose your country.', 'Ketik untuk mencari, lalu pilih negara Anda.') }}</p></div>
            <div class="field"><label for="preference-service">{{ $t('Your preferred service', 'Layanan yang Anda pilih') }}</label><div class="select-wrap"><select id="preference-service" name="preferred_service" required aria-describedby="service-help"><option value="">{{ $t('Choose a service', 'Pilih layanan') }}</option><optgroup label="{{ $t('Services', 'Layanan') }}">@foreach($landingServices as $service)<option value="{{ $service[0] }}">{{ $t($service[0], $service[1]) }}</option>@endforeach</optgroup><optgroup label="{{ $t('VISA Types', 'Jenis VISA') }}">@foreach($visaTypes as $visa)<option value="{{ $visa[0] }}">{{ $t($visa[0], $visa[1]) }}</option>@endforeach</optgroup></select></div><p id="service-help" class="preference-helper" data-default="{{ $t('Choose a service or the purpose of your stay.', 'Pilih layanan atau tujuan masa tinggal Anda.') }}" data-error="{{ $t('Choose a service to continue.', 'Pilih layanan untuk melanjutkan.') }}">{{ $t('Choose a service or the purpose of your stay.', 'Pilih layanan atau tujuan masa tinggal Anda.') }}</p></div>
            <button type="submit" class="button primary"><x-icon name="arrow-right" class="cta-icon" />{{ $t('Start My Consultation', 'Mulai Konsultasi') }}</button>
        </form>
        <div id="preference-result" class="preference-result" hidden>
            <div aria-live="polite" aria-atomic="true"><h3>{{ $t('Your enquiry, ready to discuss.', 'Pilihan Anda siap didiskusikan.') }}</h3><dl class="preference-summary"><div><dt>{{ $t('Nationality', 'Kewarganegaraan') }}</dt><dd id="result-country"></dd></div><div><dt>{{ $t('Service', 'Layanan') }}</dt><dd id="result-service"></dd></div></dl><p>{{ $t('Our team can review the requirements for your nationality and chosen service. This selection is a starting point for your consultation.', 'Tim kami dapat meninjau persyaratan sesuai kewarganegaraan dan layanan pilihan Anda. Pilihan ini menjadi langkah awal konsultasi Anda.') }}</p></div>
            <button type="button" class="button primary" id="preference-continue">{{ $t('Discuss My Selection', 'Konsultasi Pilihan Saya') }}</button>
        </div>
        <noscript><p>{{ $t('Enable JavaScript to try the selection tool, or contact our team directly.', 'Aktifkan JavaScript untuk mencoba simulasi, atau hubungi tim kami langsung.') }} <a class="text-link" href="https://wa.me/6289672966845">WhatsApp</a></p></noscript>
    </div>
</section>

<section class="why-section container" id="about-section" aria-labelledby="why-title">
    <div class="why-intro"><p class="section-label">{{ $t('About Us', 'Tentang Kami') }}</p><h2 id="why-title">{{ $t('One team.', 'Satu tim.') }}<br>{{ $t('For your next step.', 'Untuk langkah Anda.') }}</h2><p>{{ $t('OneCoreVisa helps you plan your visit and stay in Indonesia. We bring visa applications, extensions, and stay permit assistance into one conversation, in English or Indonesian.', 'OneCoreVisa membantu merencanakan kunjungan dan masa tinggal Anda di Indonesia. Pengajuan visa, perpanjangan, dan bantuan izin tinggal dapat Anda diskusikan bersama satu tim, dalam bahasa Inggris atau Indonesia.') }}</p><button class="button primary" type="button" data-consultation="General Consultation"><svg class="why-cta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M21 11.5a8.4 8.4 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.4 8.4 0 0 1-3.8-.9L3 21l1.9-5.7a8.4 8.4 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.4 8.4 0 0 1 3.8-.9h.5a8.5 8.5 0 0 1 8 8v.5Z"/></svg>{{ $t('Let’s Talk', 'Mulai Konsultasi') }}</button></div>
    <div class="why-list">
        <article><svg class="why-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="9"/><path d="m16 8-2.5 5.5L8 16l2.5-5.5L16 8Z"/></svg><div><h3>{{ $t('Your plans come first', 'Rencana Anda yang utama') }}</h3><p>{{ $t('Discuss your purpose and timeline before choosing a service.', 'Diskusikan tujuan dan waktu Anda sebelum memilih layanan.') }}</p></div></article>
        <article><svg class="why-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M9 5H6a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-3"/><rect x="9" y="2" width="6" height="5" rx="1"/><path d="m8 14 3 3 5-6"/></svg><div><h3>{{ $t('Know what to prepare', 'Pahami yang perlu disiapkan') }}</h3><p>{{ $t('Review the document requirements and ask questions before applying.', 'Tinjau kebutuhan dokumen dan ajukan pertanyaan sebelum pengajuan.') }}</p></div></article>
        <article><svg class="why-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m12 3 9 5-9 5-9-5 9-5Zm-9 9 9 5 9-5M3 16l9 5 9-5"/></svg><div><h3>{{ $t('One place to start', 'Satu tempat untuk memulai') }}</h3><p>{{ $t('Talk about visa applications, extensions, and stay permits with one team.', 'Diskusikan pengajuan visa, perpanjangan, dan izin tinggal bersama satu tim.') }}</p></div></article>
        <article><svg class="why-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M21 11.5a8.4 8.4 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.4 8.4 0 0 1-3.8-.9L3 21l1.9-5.7a8.4 8.4 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.4 8.4 0 0 1 3.8-.9h.5a8.5 8.5 0 0 1 8 8v.5Z"/><path d="M8 11h8m-8 4h5"/></svg><div><h3>{{ $t('A direct conversation', 'Komunikasi langsung') }}</h3><p>{{ $t('Reach our team on WhatsApp, in English or Indonesian.', 'Hubungi tim kami melalui WhatsApp, dalam bahasa Inggris atau Indonesia.') }}</p></div></article>
    </div>
</section>

<section id="services-section" aria-labelledby="services-title">
<div class="services-section">
    <div class="container">
        <div class="section-head"><h2 id="services-title">{{ $t('Our services', 'Layanan kami') }}</h2><p>{{ $t('From your first arrival to your next extension.', 'Dari kedatangan pertama hingga perpanjangan berikutnya.') }}</p></div>
        <div class="service-grid">
            @foreach ($serviceCategories as $slug => $category)
            <article class="service-item" data-expanded="false">
                <img class="service-thumbnail" src="{{ asset('assets/images/index/' . $category['image']) }}" alt="" width="640" height="800" loading="lazy">
                <div class="service-card-content">
                    <h3><button type="button" class="service-toggle" aria-expanded="false" aria-controls="service-details-{{ $loop->index }}">{{ $t($category['name'], $category['title_id']) }}</button></h3>
                    <div class="service-card-details" aria-hidden="true" inert id="service-details-{{ $loop->index }}" hidden>
                        <p>{{ $t(...$category['intro']) }}</p>
                        <ul class="service-benefits">@foreach($category['benefits'] as $benefit)<li>{{ $t(...$benefit) }}</li>@endforeach</ul>
                        <a class="button secondary service-learn-more" href="{{ route('services.show', $slug) }}">{{ $t('Explore Services', 'Lihat Layanan') }}<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true"><path d="M5 12h14m-5-5 5 5-5 5"/></svg></a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</div>
</section>

<section class="visa-section container" id="visa-types" aria-labelledby="visa-title">
    <div class="section-head"><h2 id="visa-title" class="section-title-with-icon"><x-icon name="passport" class="section-title-icon" />{{ $t('VISA Types', 'Jenis VISA') }}</h2><p>{{ $t('Choose your purpose. We’ll help you explore the options.', 'Pilih tujuan Anda. Kami bantu mengenali pilihan yang sesuai.') }}</p></div>
    @php($visaIcons = ['plane', 'briefcase', 'id-card', 'sun', 'users', 'book', 'badge', 'music', 'home', 'star', 'sparkles', 'globe', 'building'])
    <div class="visa-grid">
        @foreach ($visaTypes as $visa)
        <button type="button" class="visa-item" data-consultation="{{ $visa[0] }}">
            <x-icon :name="$visaIcons[$loop->index]" class="visa-icon" /><span class="visa-item-copy"><span class="visa-name">{{ $t($visa[0], $visa[1]) }}</span><span class="visa-desc">{{ $t($visa[2], $visa[3]) }}</span></span><span class="visa-arrow" aria-hidden="true">↗</span>
        </button>
        @endforeach
    </div>
    <div class="visa-help"><p>{{ $t('Not sure where to start?', 'Belum tahu harus mulai dari mana?') }}</p><button type="button" class="text-link" data-consultation="Help choosing a visa">{{ $t('Let’s Find Your Options', 'Diskusikan Pilihan Anda') }}</button></div>
</section>

<section class="process-section" id="process-section" aria-labelledby="process-title">
    <div class="container">
        <div class="section-head"><div><p class="section-label">{{ $t('Our Process', 'Proses Kami') }}</p><h2 id="process-title">{{ $t('Clear Guidance At Every Step.', 'Panduan Jelas Di Setiap Langkah.') }}</h2></div><p>{{ $t('Understand what to prepare and what comes next, from your first consultation to application updates.', 'Pahami persiapan dan langkah berikutnya, dari konsultasi awal hingga pembaruan pengajuan.') }}</p></div>
        <ol class="process-grid">
            @foreach($process as $step)
            <li><span class="step-number" aria-hidden="true">{{ $step['timeline'] }}</span><h3>{{ $step['title'] }}</h3><p>{{ $step['desc'] }}</p></li>
            @endforeach
        </ol>
    </div>
</section>

@endsection

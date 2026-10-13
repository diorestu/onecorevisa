@extends('layouts.app')

@section('content')
@php
    $t = fn ($en, $id) => $lang === 'id' ? $id : $en;
    $landingServices = [
        ['Visa Extensions', 'Perpanjangan Visa',
            'Extend your stay in Indonesia with our hassle-free visa extension service. Multiple extension options available.',
            'Perpanjang masa tinggal Anda di Indonesia dengan layanan perpanjangan visa tanpa repot. Tersedia beragam pilihan perpanjangan.',
            ['30-60 day extensions', 'Fast processing', 'Document assistance'],
            ['Perpanjangan 30-60 hari', 'Proses cepat', 'Bantuan dokumen']],
        ['E-Visa VOA', 'E-Visa VOA',
            'Visa on Arrival available for 90+ countries. Get your e-VOA online before you travel for seamless entry.',
            'Visa on Arrival tersedia untuk 90+ negara. Ajukan e-VOA secara online sebelum berangkat untuk kemudahan masuk.',
            ['30 days validity', 'Extendable once', 'Online application'],
            ['Masa berlaku 30 hari', 'Dapat diperpanjang sekali', 'Pengajuan online']],
        ['Single Entry Visas', 'Visa Sekali Masuk',
            'Perfect for longer stays. Single entry visas for tourism, business, education, and more.',
            'Cocok untuk masa tinggal lebih lama. Visa sekali masuk untuk wisata, bisnis, pendidikan, dan kebutuhan lainnya.',
            ['Up to 60 days', 'Multiple purposes', 'Pre-approved'],
            ['Hingga 60 hari', 'Beragam tujuan', 'Disetujui sebelum berangkat']],
        ['Multiple Entry Visas', 'Visa Beberapa Kali Masuk',
            'Frequent traveler? Get a multiple entry visa for flexible travel over 1-2 years.',
            'Sering bepergian? Dapatkan visa beberapa kali masuk untuk perjalanan fleksibel selama 1-2 tahun.',
            ['1-2 year validity', 'Unlimited entries', 'Business & leisure'],
            ['Masa berlaku 1-2 tahun', 'Masuk tanpa batas', 'Bisnis & liburan']],
    ];
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
    <p class="hero-intro">One step solution.</p>
    <h1 id="hero-title">ONECORE VISA</h1><p class="hero-tagline">{{ $t('Your next chapter in Indonesia.', 'Babak baru Anda di Indonesia.') }}</p>
    <div class="hero-bottom">
        <p>{{ $t('A short visit. A new opportunity. A place to call home. Find the visa that fits your plans, with OneCoreVisa beside you.', 'Kunjungan singkat. Peluang baru. Tempat untuk menetap. Temukan visa yang sesuai dengan rencana Anda bersama OneCoreVisa.') }}</p>
        <div class="hero-actions">
            <button class="button primary" type="button" data-consultation="General Consultation">{{ $t('Talk to our team', 'Konsultasi dengan kami') }}</button>
            <a class="text-link" href="#preference-section">{{ $t('Find your preference', 'Pilih kebutuhan Anda') }} <span aria-hidden="true">↓</span></a>
        </div>
    </div>
<section class="preference-section" id="preference-section" aria-labelledby="preference-title">
    <div class="preference-inner">
        <div class="section-head preference-cta-head"><div><p class="section-label">{{ $t('Check your preference', 'Pilih kebutuhan Anda') }}</p><h2 id="preference-title">{{ $t('Ready for your next step?', 'Siap untuk langkah berikutnya?') }}</h2></div><p>{{ $t('Choose your nationality and service. Let’s start planning your stay in Indonesia.', 'Pilih kewarganegaraan dan layanan. Mari mulai merencanakan masa tinggal Anda di Indonesia.') }}</p></div>
        <form id="preference-form" class="preference-form" novalidate>
            <div class="field"><label for="preference-country">{{ $t('Country of nationality', 'Negara kewarganegaraan') }}</label><input id="preference-country" name="country" list="country-options" autocomplete="off" placeholder="{{ $t('Search your country', 'Cari negara Anda') }}" required aria-describedby="country-help"><datalist id="country-options"></datalist><p id="country-help" class="preference-helper" data-default="{{ $t('Type to search, then choose your country.', 'Ketik untuk mencari, lalu pilih negara Anda.') }}" data-error="{{ $t('Choose a country from the list to continue.', 'Pilih negara dari daftar untuk melanjutkan.') }}">{{ $t('Type to search, then choose your country.', 'Ketik untuk mencari, lalu pilih negara Anda.') }}</p></div>
            <div class="field"><label for="preference-service">{{ $t('Your preferred service', 'Layanan yang Anda pilih') }}</label><div class="select-wrap"><select id="preference-service" name="preferred_service" required aria-describedby="service-help"><option value="">{{ $t('Choose a service', 'Pilih layanan') }}</option><optgroup label="{{ $t('Services', 'Layanan') }}">@foreach($landingServices as $service)<option value="{{ $service[0] }}">{{ $t($service[0], $service[1]) }}</option>@endforeach</optgroup><optgroup label="{{ $t('Visa types', 'Jenis visa') }}">@foreach($visaTypes as $visa)<option value="{{ $visa[0] }}">{{ $t($visa[0], $visa[1]) }}</option>@endforeach</optgroup></select></div><p id="service-help" class="preference-helper" data-default="{{ $t('Choose a service or the purpose of your stay.', 'Pilih layanan atau tujuan masa tinggal Anda.') }}" data-error="{{ $t('Choose a service to continue.', 'Pilih layanan untuk melanjutkan.') }}">{{ $t('Choose a service or the purpose of your stay.', 'Pilih layanan atau tujuan masa tinggal Anda.') }}</p></div>
            <button type="submit" class="button primary">{{ $t('Start my consultation', 'Mulai konsultasi') }}</button>
        </form>
        <div id="preference-result" class="preference-result" hidden>
            <div aria-live="polite" aria-atomic="true"><h3>{{ $t('Your enquiry, ready to discuss.', 'Pilihan Anda siap didiskusikan.') }}</h3><dl class="preference-summary"><div><dt>{{ $t('Nationality', 'Kewarganegaraan') }}</dt><dd id="result-country"></dd></div><div><dt>{{ $t('Service', 'Layanan') }}</dt><dd id="result-service"></dd></div></dl><p>{{ $t('Our team can review the requirements for your nationality and chosen service. This selection is a starting point for your consultation.', 'Tim kami dapat meninjau persyaratan sesuai kewarganegaraan dan layanan pilihan Anda. Pilihan ini menjadi langkah awal konsultasi Anda.') }}</p></div>
            <button type="button" class="button primary" id="preference-continue">{{ $t('Discuss my selection', 'Konsultasi pilihan saya') }}</button>
        </div>
        <noscript><p>{{ $t('Enable JavaScript to try the selection tool, or contact our team directly.', 'Aktifkan JavaScript untuk mencoba simulasi, atau hubungi tim kami langsung.') }} <a class="text-link" href="https://wa.me/6289672966845">WhatsApp</a></p></noscript>
    </div>
</section>
    <div class="hero-note"><span>One step solution.</span><span>{{ $t('Visit. Work. Live in Indonesia.', 'Kunjungi. Bekerja. Tinggal di Indonesia.') }}</span></div>
</div>
</section>

<section class="why-section container" id="about-section" aria-labelledby="why-title">
    <div class="why-intro"><p class="section-label">{{ $t('About us', 'Tentang kami') }}</p><h2 id="why-title">{{ $t('One team.', 'Satu tim.') }}<br>{{ $t('For your next step.', 'Untuk langkah Anda.') }}</h2><p>{{ $t('OneCoreVisa helps you plan your visit and stay in Indonesia. We bring visa applications, extensions, and stay permit assistance into one conversation, in English or Indonesian.', 'OneCoreVisa membantu merencanakan kunjungan dan masa tinggal Anda di Indonesia. Pengajuan visa, perpanjangan, dan bantuan izin tinggal dapat Anda diskusikan bersama satu tim, dalam bahasa Inggris atau Indonesia.') }}</p><button class="button primary" type="button" data-consultation="General Consultation">{{ $t('Let’s talk', 'Mulai konsultasi') }}</button></div>
    <div class="why-list">
        <article><h3>{{ $t('Your plans come first', 'Rencana Anda yang utama') }}</h3><p>{{ $t('Discuss your purpose and timeline before choosing a service.', 'Diskusikan tujuan dan waktu Anda sebelum memilih layanan.') }}</p></article>
        <article><h3>{{ $t('Know what to prepare', 'Pahami yang perlu disiapkan') }}</h3><p>{{ $t('Review the document requirements and ask questions before applying.', 'Tinjau kebutuhan dokumen dan ajukan pertanyaan sebelum pengajuan.') }}</p></article>
        <article><h3>{{ $t('One place to start', 'Satu tempat untuk memulai') }}</h3><p>{{ $t('Talk about visa applications, extensions, and stay permits with one team.', 'Diskusikan pengajuan visa, perpanjangan, dan izin tinggal bersama satu tim.') }}</p></article>
        <article><h3>{{ $t('A direct conversation', 'Komunikasi langsung') }}</h3><p>{{ $t('Reach our team on WhatsApp, in English or Indonesian.', 'Hubungi tim kami melalui WhatsApp, dalam bahasa Inggris atau Indonesia.') }}</p></article>
    </div>
</section>

<section id="services-section" aria-labelledby="services-title">
<div class="services-section">
    <div class="container">
        <div class="section-head"><h2 id="services-title">{{ $t('Our services', 'Layanan kami') }}</h2><p>{{ $t('From your first arrival to your next extension.', 'Dari kedatangan pertama hingga perpanjangan berikutnya.') }}</p></div>
        <div class="service-grid">
            @foreach ($landingServices as $service)
            <article class="service-item" data-expanded="false">
                <img class="service-thumbnail" src="{{ asset('assets/images/index/' . ['header-slider2.webp', 'about-img.webp', 'header-slider3.webp', 'header-slider1.webp'][$loop->index]) }}" alt="" width="640" height="800" loading="lazy">
                <div class="service-card-content">
                    <h3><button type="button" class="service-toggle" aria-expanded="false" aria-controls="service-details-{{ $loop->index }}">{{ $t($service[0], $service[1]) }}</button></h3>
                    <div class="service-card-details" aria-hidden="true" inert id="service-details-{{ $loop->index }}" hidden>
                        <p>{{ $t($service[2], $service[3]) }}</p>
                        <ul class="service-benefits">@foreach($t($service[4], $service[5]) as $benefit)<li>{{ $benefit }}</li>@endforeach</ul>
                        <a class="button secondary service-learn-more" href="{{ route('services.show', ['visa-extensions', 'e-visa-voa', 'single-entry-visas', 'multiple-entry-visas'][$loop->index]) }}">{{ $t('Learn More', 'Selengkapnya') }}<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true"><path d="M5 12h14m-5-5 5 5-5 5"/></svg></a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</div>

<section class="visa-section container" id="visa-types" aria-labelledby="visa-title">
    <div class="section-head"><h2 id="visa-title">{{ $t('Visa types', 'Jenis visa') }}</h2><p>{{ $t('Choose your purpose. We’ll help you explore the options.', 'Pilih tujuan Anda. Kami bantu mengenali pilihan yang sesuai.') }}</p></div>
    <div class="visa-grid">
        @foreach ($visaTypes as $visa)
        <button type="button" class="visa-item" data-consultation="{{ $visa[0] }}">
            <span><span class="visa-name">{{ $t($visa[0], $visa[1]) }}</span><span class="visa-desc">{{ $t($visa[2], $visa[3]) }}</span></span><span class="visa-arrow" aria-hidden="true">↗</span>
        </button>
        @endforeach
    </div>
    <div class="visa-help"><p>{{ $t('Not sure where to start?', 'Belum tahu harus mulai dari mana?') }}</p><button type="button" class="text-link" data-consultation="Help choosing a visa">{{ $t('Let’s find your options', 'Diskusikan pilihan Anda') }}</button></div>
</section>

</section>

<section class="process-section" id="process-section" aria-labelledby="process-title">
    <div class="container">
        <div class="section-head"><div><p class="section-label">{{ $t('Our process', 'Proses kami') }}</p><h2 id="process-title">{{ $t('A simple 3-step process.', 'Proses sederhana, 3 langkah.') }}</h2></div><p>{{ $t('A clear next step, from the first conversation onward.', 'Langkah yang jelas sejak percakapan pertama.') }}</p></div>
        <ol class="process-grid">
            <li><span class="step-number" aria-hidden="true">01</span><h3>{{ $t('Tell us your plans', 'Ceritakan rencana Anda') }}</h3><p>{{ $t('Share your travel purpose, nationality, and intended stay. We’ll discuss the options with you.', 'Sampaikan tujuan perjalanan, kewarganegaraan, dan rencana tinggal. Kami akan mendiskusikan pilihannya.') }}</p></li>
            <li><span class="step-number" aria-hidden="true">02</span><h3>{{ $t('Prepare your documents', 'Siapkan dokumen') }}</h3><p>{{ $t('Work with our team to review the requirements, documents, and fees before proceeding.', 'Bersama tim kami, tinjau persyaratan, dokumen, dan biaya sebelum melanjutkan.') }}</p></li>
            <li><span class="step-number" aria-hidden="true">03</span><h3>{{ $t('Apply & stay updated', 'Ajukan & pantau proses') }}</h3><p>{{ $t('We assist with your application and guide you through updates and any next steps.', 'Kami membantu pengajuan dan memberi panduan untuk perkembangan serta langkah berikutnya.') }}</p></li>
        </ol>
    </div>
</section>

@endsection

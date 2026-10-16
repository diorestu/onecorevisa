@php
    $lang = $lang ?? 'en';
    $t = fn ($en, $id) => \App\Support\SiteLanguage::text($en, $id, $lang);
    $homeUrl = route('home', ['lang' => $lang]);
@endphp
<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/tokens.css') }}?v={{ filemtime(public_path('assets/css/tokens.css')) }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/tom-select/tom-select.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/onecore-theme.css') }}?v={{ filemtime(public_path('assets/css/onecore-theme.css')) }}">
</head>
<body class="{{ isset($serviceDetail) ? 'service-detail-page' : '' }}">
    <a class="skip-link" href="#main">{{ $t('Skip To Content', 'Lewati Ke Konten') }}</a>
    <header class="site-header {{ isset($serviceDetail) ? 'is-solid' : '' }}">
        <div class="header-contact-bar"><div class="container header-contact-inner"><a href="https://wa.me/6289672966845" target="_blank" rel="noopener noreferrer"><x-icon name="whatsapp" /><span>+62 896-7296-6845</span></a><a href="{{ config('social.instagram_url') }}" target="_blank" rel="noopener noreferrer"><x-icon name="instagram" /><span>@onecorevisa</span></a></div></div>
        <div class="container header-inner">
            <a class="brand" href="{{ $homeUrl }}" aria-label="OneCoreVisa — {{ $t('home', 'beranda') }}"><img class="brand-logo-dark" src="{{ asset('assets/images/onecore-logo-horizontal.png') }}" width="822" height="240" alt="OneCore Visa"><img class="brand-logo-white" src="{{ asset('assets/images/onecore-logo-horizontal-white.png') }}" width="822" height="240" alt=""></a>
            <nav class="desktop-nav" aria-label="{{ $t('Main navigation', 'Navigasi utama') }}"><a href="{{ isset($serviceDetail) ? $homeUrl : '' }}#about-section">{{ $t('About Us', 'Tentang Kami') }}</a><a href="{{ isset($serviceDetail) ? $homeUrl : '' }}#services-section">{{ $t('Visa & KITAS Services', 'Layanan Visa & KITAS') }}</a><a href="{{ route('services.show', ['service' => 'company-formation', 'lang' => $lang]) }}">{{ $t('Legality Services', 'Layanan Legalitas') }}</a><a href="{{ isset($serviceDetail) ? $homeUrl : '' }}#process-section">{{ $t('Our Process', 'Proses Kami') }}</a></nav>
            <div class="header-actions"><x-language-dropdown :lang="$lang" /><button type="button" class="button primary header-cta" data-consultation="General Consultation"><x-icon name="chat" class="cta-icon" />{{ $t('Contact Us', 'Hubungi Kami') }}</button><button class="menu-toggle" type="button" aria-expanded="false" aria-controls="mobile-nav">{{ $t('Menu', 'Menu') }} <span aria-hidden="true">☰</span></button></div>
        </div>
        <nav class="mobile-nav container" id="mobile-nav" aria-label="{{ $t('Mobile navigation', 'Navigasi ponsel') }}" hidden><a href="{{ isset($serviceDetail) ? $homeUrl : '' }}#about-section">{{ $t('About Us', 'Tentang Kami') }}</a><a href="{{ isset($serviceDetail) ? $homeUrl : '' }}#services-section">{{ $t('Visa & KITAS Services', 'Layanan Visa & KITAS') }}</a><a href="{{ route('services.show', ['service' => 'company-formation', 'lang' => $lang]) }}">{{ $t('Legality Services', 'Layanan Legalitas') }}</a><a href="{{ isset($serviceDetail) ? $homeUrl : '' }}#process-section">{{ $t('Our Process', 'Proses Kami') }}</a><button class="button primary" type="button" data-consultation="General Consultation"><x-icon name="chat" class="cta-icon" />{{ $t('Contact Us', 'Hubungi Kami') }}</button></nav>
    </header>
    <main id="main">@yield('content')</main>
    <footer class="site-footer" id="contact">
        <div class="container">
            <div class="footer-main">
                <div class="footer-brand"><img class="footer-logo" src="{{ asset('assets/images/onecore-logo-horizontal.png') }}" width="822" height="240" alt="OneCore Visa"><p>{{ $t('Your plans. Our guidance.', 'Rencana Anda. Panduan kami.') }}<br>One step solution.</p>
                    <nav class="footer-social" aria-label="{{ $t('Social media', 'Media sosial') }}">
                        <a href="https://wa.me/6289672966845" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><x-icon name="whatsapp" /></a>
                        @if(config('social.instagram_url'))<a href="{{ config('social.instagram_url') }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><x-icon name="instagram" /></a>@endif
                    </nav>
                </div>
                <div class="footer-links"><h3>{{ $t('Quick links', 'Tautan cepat') }}</h3><nav aria-label="{{ $t('Quick links', 'Tautan cepat') }}">
                    <a href="{{ $homeUrl }}#about-section">{{ $t('About Us', 'Tentang Kami') }}</a>
                    <a href="{{ $homeUrl }}#services-section">{{ $t('Visa & KITAS Services', 'Layanan Visa & KITAS') }}</a>
                    <a href="{{ route('services.show', ['service' => 'company-formation', 'lang' => $lang]) }}">{{ $t('Legality Services', 'Layanan Legalitas') }}</a>
                    <a href="{{ $homeUrl }}#process-section">{{ $t('Our Process', 'Proses Kami') }}</a>
                    <a href="{{ $homeUrl }}#visa-simulator">{{ $t('Plan your visit', 'Rencanakan kunjungan Anda') }}</a>
                </nav></div>
                <div class="footer-contact"><h3>{{ $t('Start a conversation', 'Mulai percakapan') }}</h3><a href="https://wa.me/6289672966845" target="_blank" rel="noopener noreferrer"><x-icon name="whatsapp" /><span>+62 896-7296-6845</span></a><a href="mailto:onecorevisa@gmail.com"><x-icon name="mail" /><span>onecorevisa@gmail.com</span></a></div>
            </div>
            <div class="footer-bottom"><p>© {{ date('Y') }} OneCoreVisa. {{ $t('All rights reserved.', 'Hak cipta dilindungi.') }}</p><nav aria-label="{{ $t('Footer navigation', 'Navigasi footer') }}"><a href="{{ isset($serviceDetail) ? $homeUrl : '' }}#services-section">{{ $t('Services', 'Layanan') }}</a><a href="{{ isset($serviceDetail) ? $homeUrl : '' }}#process-section">{{ $t('How It Works', 'Cara Kerja') }}</a><a href="{{ isset($serviceDetail) ? $homeUrl : '' }}#about-section">{{ $t('About Us', 'Tentang Kami') }}</a></nav></div>
        </div>
    </footer>
    <a class="whatsapp-float" href="https://wa.me/6289672966845" target="_blank" rel="noopener noreferrer" aria-label="{{ $t('Chat On WhatsApp', 'Chat Di WhatsApp') }}" title="{{ $t('Chat On WhatsApp', 'Chat Di WhatsApp') }}">
        <x-icon name="whatsapp" />
    </a>
    <dialog id="consultation-dialog" aria-labelledby="consultation-title">
        <div class="dialog-head"><h2 id="consultation-title">{{ $t('Tell us your plans.', 'Ceritakan rencana Anda.') }}</h2><button type="button" class="dialog-close" aria-label="{{ $t('Close consultation', 'Tutup konsultasi') }}">×</button></div>
        <p class="dialog-intro">{{ $t('Prepare your enquiry, then continue the conversation on WhatsApp.', 'Siapkan pertanyaan Anda, lalu lanjutkan percakapan melalui WhatsApp.') }}</p>
        <form id="consultation-form" action="{{ route('consultation.submit') }}" method="POST">
            @csrf
            @if ($errors->any())<div class="form-error" role="alert">{{ $t('Please check the highlighted fields and try again.', 'Periksa kolom yang ditandai dan coba kembali.') }}</div>@endif
            <div class="form-grid">
                @foreach ([['name', $t('Full name', 'Nama lengkap'), 'text', 150, 'name'], ['nationality', $t('Nationality', 'Kewarganegaraan'), 'text', 100, 'country-name'], ['whatsapp', $t('WhatsApp number', 'Nomor WhatsApp'), 'tel', 50, 'tel'], ['email', 'Email', 'email', 150, 'email']] as $field)
                <div class="field"><label for="{{ $field[0] }}">{{ $field[1] }} @if($field[0] !== 'email')<span aria-hidden="true">*</span>@else<span class="optional">({{ $t('optional', 'opsional') }})</span>@endif</label><input id="{{ $field[0] }}" name="{{ $field[0] }}" type="{{ $field[2] }}" maxlength="{{ $field[3] }}" autocomplete="{{ $field[4] }}" value="{{ old($field[0]) }}" @if($field[0] !== 'email') required @endif @error($field[0]) aria-invalid="true" aria-describedby="{{ $field[0] }}-error" @enderror>@error($field[0])<p class="field-error" id="{{ $field[0] }}-error">{{ $message }}</p>@enderror</div>
                @endforeach
                <div class="field full"><label for="service">{{ $t('Service or visa type', 'Layanan atau jenis visa') }}</label><div class="select-wrap"><select id="service" name="service"><option value="General Consultation">{{ $t('Help me choose', 'Bantu saya memilih') }}</option>@foreach (['Visa Extensions' => 'Perpanjangan Visa', 'E-Visa VOA' => 'E-Visa VOA', 'Single Entry Visas' => 'Visa Sekali Masuk', 'Multiple Entry Visas' => 'Visa Beberapa Kali Masuk', 'Tourism' => 'Wisata', 'Business & Investment' => 'Bisnis & Investasi', 'Work & Employment' => 'Kerja & Ketenagakerjaan', 'Retirement' => 'Pensiun', 'Family Dependent' => 'Keluarga', 'Education & Training' => 'Pendidikan & Pelatihan', 'Professional' => 'Profesional', 'Performer' => 'Pelaku Pertunjukan', 'Second Home' => 'Second Home', 'Golden Visa' => 'Golden Visa', 'Global Talent' => 'Global Talent', 'Ex-Indonesian Citizen' => 'Eks Warga Negara Indonesia', 'Permanent Residency' => 'Izin Tinggal Tetap'] as $option => $translation)<option value="{{ $option }}" @selected(old('service') === $option)>{{ $t($option, $translation) }}</option>@endforeach
                    @foreach(($serviceCategories ?? []) as $category)<option value="{{ $category['name'] }}" @selected(old('service') === $category['name'])>{{ $t($category['name'], $category['title_id']) }}</option>@endforeach
                    <optgroup label="{{ $t('Specific Services', 'Layanan Spesifik') }}">@foreach(($services ?? []) as $item)<option value="{{ $item['title'] }}" @selected(old('service') === $item['title'])>{{ $item['title'] }}</option>@endforeach</optgroup></select></div>@error('service')<p class="field-error">{{ $message }}</p>@enderror</div>
                <div class="field full"><label for="location">{{ $t('Current location', 'Lokasi saat ini') }}</label><div class="select-wrap"><select id="location" name="location"><option value="Currently in Indonesia" @selected(old('location') === 'Currently in Indonesia')>{{ $t('In Indonesia', 'Di Indonesia') }}</option><option value="Currently Overseas" @selected(old('location') === 'Currently Overseas')>{{ $t('Outside Indonesia', 'Di luar Indonesia') }}</option></select></div></div>
                <div class="field full"><label for="notes">{{ $t('Your plans or questions', 'Rencana atau pertanyaan Anda') }} <span class="optional">({{ $t('optional', 'opsional') }})</span></label><textarea id="notes" name="notes" rows="3" maxlength="1000">{{ old('notes') }}</textarea>@error('notes')<p class="field-error">{{ $message }}</p>@enderror</div>
            </div>
            <p class="form-note">{{ $t('Your details will be included in a WhatsApp message. Review it before sending.', 'Data Anda akan disertakan dalam pesan WhatsApp. Tinjau sebelum mengirim.') }}</p>
            <div class="dialog-actions"><button type="button" class="button secondary dialog-cancel">{{ $t('Cancel', 'Batal') }}</button><button type="submit" class="button primary" data-loading-label="{{ $t('Opening WhatsApp…', 'Membuka WhatsApp…') }}">{{ $t('Continue To WhatsApp', 'Lanjut Ke WhatsApp') }}</button></div>
        </form>
    </dialog>
    <script src="{{ asset('assets/vendor/tom-select/tom-select.complete.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/onecore-landing.js') }}?v={{ filemtime(public_path('assets/js/onecore-landing.js')) }}" defer></script>
    @if(!isset($serviceDetail))<script src="{{ asset('assets/js/visa-simulator.js') }}?v={{ filemtime(public_path('assets/js/visa-simulator.js')) }}" defer></script>@endif
    @if ($errors->any())<script>document.addEventListener('DOMContentLoaded', () => { document.querySelector('#consultation-dialog').showModal(); document.querySelector('[aria-invalid="true"]')?.focus(); });</script>@endif
</body>
</html>

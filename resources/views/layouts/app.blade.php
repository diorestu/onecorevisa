@php
    $lang = $lang ?? 'en';
    $t = fn ($en, $id) => $lang === 'id' ? $id : $en;
@endphp
<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $t('OneCoreVisa — Indonesian visa, extension and stay permit assistance. Explore your options and speak with our team.', 'OneCoreVisa — Bantuan visa, perpanjangan, dan izin tinggal Indonesia. Kenali pilihan Anda dan konsultasi bersama tim kami.') }}">
    <title>{{ isset($serviceDetail) ? $t($serviceDetail['name'], $serviceDetail['title_id']) . ' | OneCoreVisa' : 'OneCoreVisa | ' . $t('Your next chapter in Indonesia', 'Babak baru Anda di Indonesia') }}</title>
    <link rel="icon" href="{{ asset('assets/images/onecore-favicon.png') }}" type="image/png">
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
        <div class="container header-inner">
            <a class="brand" href="{{ route('home') }}" aria-label="OneCoreVisa — {{ $t('home', 'beranda') }}"><img class="brand-logo-dark" src="{{ asset('assets/images/onecore-logo-horizontal.png') }}" width="822" height="240" alt="OneCore Visa"><img class="brand-logo-white" src="{{ asset('assets/images/onecore-logo-horizontal-white.png') }}" width="822" height="240" alt=""></a>
            <nav class="desktop-nav" aria-label="{{ $t('Main navigation', 'Navigasi utama') }}"><a href="{{ isset($serviceDetail) ? route('home') : '' }}#about-section">{{ $t('About Us', 'Tentang Kami') }}</a><a href="{{ isset($serviceDetail) ? route('home') : '' }}#services-section">{{ $t('Our Services', 'Layanan Kami') }}</a><a href="{{ isset($serviceDetail) ? route('home') : '' }}#process-section">{{ $t('Our Process', 'Proses Kami') }}</a></nav>
            <div class="header-actions"><div class="language-switch" aria-label="{{ $t('Language', 'Bahasa') }}"><a href="{{ route('lang.switch', 'en') }}" lang="en" aria-label="English" @if($lang === 'en') aria-current="true" @endif>EN</a><a href="{{ route('lang.switch', 'id') }}" lang="id" aria-label="Bahasa Indonesia" @if($lang === 'id') aria-current="true" @endif>ID</a></div><button type="button" class="button primary header-cta" data-consultation="General Consultation"><x-icon name="chat" class="cta-icon" />{{ $t('Get In Touch', 'Hubungi Kami') }}</button><button class="menu-toggle" type="button" aria-expanded="false" aria-controls="mobile-nav">{{ $t('Menu', 'Menu') }} <span aria-hidden="true">☰</span></button></div>
        </div>
        <nav class="mobile-nav container" id="mobile-nav" aria-label="{{ $t('Mobile navigation', 'Navigasi ponsel') }}" hidden><a href="{{ isset($serviceDetail) ? route('home') : '' }}#about-section">{{ $t('About Us', 'Tentang Kami') }}</a><a href="{{ isset($serviceDetail) ? route('home') : '' }}#services-section">{{ $t('Our Services', 'Layanan Kami') }}</a><a href="{{ isset($serviceDetail) ? route('home') : '' }}#process-section">{{ $t('Our Process', 'Proses Kami') }}</a><button class="button primary" type="button" data-consultation="General Consultation"><x-icon name="chat" class="cta-icon" />{{ $t('Get In Touch', 'Hubungi Kami') }}</button></nav>
    </header>
    <main id="main">@yield('content')</main>
    <footer class="site-footer" id="contact">
        <div class="container">
            <div class="footer-main"><div><img class="footer-logo" src="{{ asset('assets/images/onecore-logo-horizontal.png') }}" width="822" height="240" alt="OneCore Visa"><p>{{ $t('Your plans. Our guidance.', 'Rencana Anda. Panduan kami.') }}<br>One step solution.</p></div><div class="footer-contact"><p>{{ $t('Start a conversation', 'Mulai percakapan') }}</p><a href="https://wa.me/6289672966845" target="_blank" rel="noopener noreferrer">+62 896-7296-6845</a><a href="mailto:hello@onecorevisa.com">hello@onecorevisa.com</a></div></div>
            <div class="footer-bottom"><p>© {{ date('Y') }} OneCoreVisa. {{ $t('All rights reserved.', 'Hak cipta dilindungi.') }}</p><nav aria-label="{{ $t('Footer navigation', 'Navigasi footer') }}"><a href="{{ isset($serviceDetail) ? route('home') : '' }}#services-section">{{ $t('Services', 'Layanan') }}</a><a href="{{ isset($serviceDetail) ? route('home') : '' }}#process-section">{{ $t('How It Works', 'Cara Kerja') }}</a><a href="{{ isset($serviceDetail) ? route('home') : '' }}#about-section">{{ $t('About Us', 'Tentang Kami') }}</a></nav></div>
        </div>
    </footer>
    <a class="whatsapp-float" href="https://wa.me/6289672966845" target="_blank" rel="noopener noreferrer" aria-label="{{ $t('Chat On WhatsApp', 'Chat Di WhatsApp') }}" title="{{ $t('Chat On WhatsApp', 'Chat Di WhatsApp') }}">
        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.52 3.48A11.91 11.91 0 0 0 12.04 0C5.46 0 .1 5.36.1 11.94c0 2.1.55 4.16 1.6 5.98L0 24l6.24-1.64a11.94 11.94 0 0 0 5.8 1.48h.01C18.63 23.84 24 18.48 24 11.9c0-3.19-1.24-6.18-3.48-8.42ZM12.05 21.83a9.9 9.9 0 0 1-5.05-1.38l-.36-.21-3.7.97.99-3.61-.24-.37a9.87 9.87 0 0 1-1.52-5.29c0-5.47 4.45-9.92 9.92-9.92 2.65 0 5.13 1.03 7 2.9a9.85 9.85 0 0 1 2.9 7c0 5.47-4.45 9.91-9.94 9.91Zm5.44-7.43c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.39-1.47-.89-.8-1.49-1.78-1.66-2.08-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.03-.52-.07-.15-.67-1.61-.92-2.21-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.22 3.08c.15.2 2.1 3.2 5.09 4.49.71.31 1.27.5 1.7.64.72.23 1.37.2 1.88.12.57-.09 1.76-.72 2.01-1.42.25-.69.25-1.29.17-1.42-.07-.12-.27-.2-.57-.35Z"/></svg>
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
    @if ($errors->any())<script>document.addEventListener('DOMContentLoaded', () => { document.querySelector('#consultation-dialog').showModal(); document.querySelector('[aria-invalid="true"]')?.focus(); });</script>@endif
</body>
</html>

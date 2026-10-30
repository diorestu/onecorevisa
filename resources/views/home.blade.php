@extends('layouts.app')

@section('content')
@php
    $t = fn ($en, $id) => \App\Support\SiteLanguage::text($en, $id, $lang);
    extract(app(\App\Support\CmsContent::class)->homepage($lang));
@endphp
<section class="hero" id="hero" aria-labelledby="hero-title">
@php($hero=app(\App\Support\CmsContent::class)->page('hero',$lang))
@if(!empty($hero['image']))<img class="cms-hero-background" src="{{ \App\Support\CmsContent::image($hero['image']) }}" alt="" width="1600" height="1000" fetchpriority="high">@endif
<div class="container hero-content">
    <p class="hero-intro">{{ app(\App\Support\CmsContent::class)->page('hero',$lang,['brand'=>'OneCore (One Step Solution)'])['brand'] }}</p>
    <h1 id="hero-title"><span>{{ $t('Visa assistance for', 'Bantuan visa untuk') }}</span> {{ $t('your stay in Indonesia.', 'masa tinggal Anda di Indonesia.') }}</h1>
    <div class="hero-bottom">
        <p>{{ $t('From your first visit to a longer stay, OneCore helps you find the right visa and prepare your application. Talk to our team about visa extensions, KITAS, or KITAP.', 'Dari kunjungan pertama hingga rencana tinggal lebih lama, OneCore membantu memilih visa dan menyiapkan pengajuan Anda. Diskusikan perpanjangan visa, KITAS, atau KITAP bersama tim kami.') }}</p>
        <div class="hero-actions">
            <button class="button primary" type="button" data-consultation="General Consultation">{{ $t('Talk to OneCore', 'Konsultasi dengan OneCore') }}</button>
            <a class="text-link" href="#visa-simulator">{{ $t('Find My Visa Options', 'Cari Pilihan Visa Saya') }} <span aria-hidden="true">↓</span></a>
        </div>
    </div>

</div>
</section>

@include('partials.visa-simulator')

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
        <div class="section-head"><h2 id="services-title">{{ $t('Our services', 'Layanan kami') }}</h2><p>{{ $t('From your first arrival to long-term residency.', 'Dari kedatangan pertama hingga izin tinggal jangka panjang.') }}</p></div>
        <div class="service-grid">
            @foreach ($serviceHighlights as $highlight)
            <article class="service-feature-card">
                <img class="service-thumbnail" src="{{ \App\Support\CmsContent::image($highlight['image']) }}" alt="" width="640" height="800" loading="lazy">
                <div class="service-feature-copy">
                    <h3>{{ $t(...$highlight['title']) }}</h3>
                    <p>{{ $t(...$highlight['description']) }}</p>
                    <ul class="service-feature-benefits">@foreach($highlight['benefits'] as $benefit)<li><span class="service-feature-check" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 12 4 4 8-8"/></svg></span>{{ $t(...$benefit) }}</li>@endforeach</ul>
                    <a class="service-feature-link" href="{{ route('services.show', ['service' => $highlight['slug'], 'lang' => $lang]) }}" aria-label="{{ $t('Learn more about ' . $highlight['title'][0], 'Selengkapnya tentang ' . $highlight['title'][1]) }}">{{ $t('Learn More', 'Selengkapnya') }}<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true"><path d="M5 12h14m-5-5 5 5-5 5"/></svg></a>
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
            <x-icon :name="$visaIcons[$loop->index] ?? 'globe'" class="visa-icon" /><span class="visa-item-copy"><span class="visa-name">{{ $t($visa[0], $visa[1]) }}</span><span class="visa-desc">{{ $t($visa[2], $visa[3]) }}</span></span><span class="visa-arrow" aria-hidden="true">↗</span>
        </button>
        @endforeach
    </div>
    <div class="visa-help"><p>{{ $t('Not sure where to start?', 'Belum tahu harus mulai dari mana?') }}</p><button type="button" class="text-link" data-consultation="Help choosing a visa">{{ $t('Let’s Find Your Options', 'Diskusikan Pilihan Anda') }}</button></div>
</section>

<section class="process-section" id="process-section" aria-labelledby="process-title">
    <div class="container">
        <div class="section-head"><div><p class="section-label">{{ $t('Our Process', 'Proses Kami') }}</p><h2 id="process-title">{{ $t('Your visa, step by step.', 'Urus visa, selangkah demi selangkah.') }}</h2></div><p>{{ $t('From consultation to application updates.', 'Dari konsultasi hingga kabar pengajuan.') }}</p></div>
        <ol class="process-grid">
            @foreach($process as $step)
            <li><span class="step-number" aria-hidden="true">{{ $t($step['timeline'], $step['timeline']) }}</span><h3>{{ $t($step['title'], $step['title']) }}</h3><p>{{ $t($step['desc'], $step['desc']) }}</p></li>
            @endforeach
        </ol>
    </div>
</section>

<section class="news-section container" id="news-section" aria-labelledby="news-title">
    <div class="section-head"><h2 id="news-title">{{ $t('News', 'Berita') }}</h2><a class="text-link" href="{{ route('articles.index',['lang'=>$lang==='id'?'id':'en']) }}">{{ $t('All articles','Semua artikel') }}</a></div>
    @php($articles=app(\App\Support\CmsContent::class)->latestArticles())
    @if($articles->isNotEmpty())@include('articles.cards')@else<p class="news-empty">{{ $t('No news has been published yet. Check back for updates.', 'Belum ada berita yang diterbitkan. Kunjungi kembali untuk informasi terbaru.') }}</p>@endif
</section>

@if(app(\App\Support\CmsContent::class)->ready() && !empty($faqs))
<section class="cms-faq container" aria-labelledby="faq-title"><h2 id="faq-title">{{ $t('Frequently asked questions','Pertanyaan umum') }}</h2>@foreach($faqs as $faq)<details><summary>{{ $faq['q'] }}</summary><p>{{ $faq['a'] }}</p></details>@endforeach</section>
@endif

@endsection

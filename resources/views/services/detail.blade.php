@extends('layouts.app')
@section('content')
@php($t = fn ($en, $id) => \App\Support\SiteLanguage::text($en, $id, $lang))
<div class="service-profile container">
    <nav class="service-breadcrumbs" aria-label="{{ $t('Breadcrumb', 'Jejak Navigasi') }}">
        <ol>
            <li><a href="{{ route('home', ['lang' => $lang]) }}#services-section">{{ $t('Services', 'Layanan') }}</a></li>
            <li><a href="{{ route('services.show', ['service' => $categorySlug, 'lang' => $lang]) }}">{{ $t($categoryDetail['name'], $categoryDetail['title_id']) }}</a></li>
            <li aria-current="page">{{ $serviceLine['code'] }}</li>
        </ol>
    </nav>

    <div class="service-reading-layout">
        <article class="service-reading-column">
            <header class="service-profile-header">
                <p class="section-label">{{ $t($categoryDetail['name'], $categoryDetail['title_id']) }}</p>
                <h1 id="service-page-title">{{ $serviceLine['title'] }}</h1>
                <p class="service-profile-intro">{{ $serviceLine['whatsAllowed'][0] }}</p>
                <button class="button primary service-mobile-enquiry" type="button" data-consultation="{{ $serviceLine['title'] }}"><x-icon name="chat" class="cta-icon" />{{ $t('Request A Quote', 'Minta Penawaran') }}</button>
            </header>

            <nav class="service-section-nav" aria-label="{{ $t('On This Page', 'Di Halaman Ini') }}">
                <a href="#service-overview">{{ $t('Overview', 'Ringkasan') }}</a>
                <a href="#service-activities">{{ $t('Activities', 'Aktivitas') }}</a>
                <a href="#service-documents">{{ $t('Documents', 'Dokumen') }}</a>
            </nav>

            <section class="service-profile-section" id="service-overview" aria-labelledby="service-overview-title">
                <h2 id="service-overview-title">{{ $t('Service Overview', 'Ringkasan Layanan') }}</h2>
                <dl class="service-summary-facts">
                    <div>
                        <dt><x-icon :name="$serviceLine['category'] === 'company' ? 'building' : 'calendar'" class="service-fact-icon" />{{ $t($serviceLine['category'] === 'company' ? 'Business Status' : 'Length Of Stay', $serviceLine['category'] === 'company' ? 'Status Usaha' : 'Lama Tinggal') }}</dt>
                        <dd>{{ $serviceLine['lengthOfStay'] }}</dd>
                    </div>
                    <div>
                        <dt><x-icon name="clock" class="service-fact-icon" />{{ $t('Processing Time', 'Waktu Proses') }}</dt>
                        <dd>{{ $serviceLine['processingTime'] }}</dd>
                    </div>
                    <div>
                        <dt><x-icon name="id-card" class="service-fact-icon" />{{ $t('Validity', 'Masa Berlaku') }}</dt>
                        <dd>{{ $serviceLine['visaValidity'] }}</dd>
                    </div>
                </dl>
            </section>

            <section class="service-profile-section service-activities" id="service-activities" aria-label="{{ $t('Activities And Restrictions', 'Aktivitas Dan Pembatasan') }}">
                <div>
                    <h2><x-icon name="check-circle" class="service-heading-icon" />{{ $t('Allowed Activities', 'Aktivitas Yang Diizinkan') }}</h2>
                    <ul>@foreach($serviceLine['whatsAllowed'] as $activity)<li>{{ $activity }}</li>@endforeach</ul>
                </div>
                <div>
                    <h2><x-icon name="minus-circle" class="service-heading-icon" />{{ $t('Restrictions', 'Pembatasan') }}</h2>
                    <ul>@foreach($serviceLine['whatsNotAllowed'] as $activity)<li>{{ $activity }}</li>@endforeach</ul>
                </div>
            </section>

            <section class="service-profile-section service-documents" id="service-documents" aria-labelledby="service-documents-title">
                <div class="service-documents-heading">
                    <h2 id="service-documents-title"><x-icon name="document" class="service-heading-icon" />{{ $t('Document Requirements', 'Persyaratan Dokumen') }}</h2>
                    <p>{{ $serviceLine['documentIntro'] ?? $t('Prepare these documents for your consultation.', 'Siapkan dokumen berikut untuk konsultasi Anda.') }}</p>
                </div>
                <ol>@foreach($serviceLine['documentRequirements'] as $document)<li>{{ $document }}</li>@endforeach</ol>
            </section>

            @if(!empty($serviceLine['additionalInformation']))
            <section class="service-profile-section" aria-labelledby="service-additional-title">
                <h2 id="service-additional-title">{{ $t('Additional Information Required', 'Informasi Tambahan Yang Diperlukan') }}</h2>
                <ul>@foreach($serviceLine['additionalInformation'] as $information)<li>{{ $information }}</li>@endforeach</ul>
            </section>
            @endif

            <a class="text-link service-back-link service-profile-back" href="{{ route('services.show', ['service' => $categorySlug, 'lang' => $lang]) }}"><x-icon name="chevron-left" />{{ $t('Back To', 'Kembali Ke') }} {{ $t($categoryDetail['name'], $categoryDetail['title_id']) }}</a>
        </article>

        @include('services.consultation')
    </div>
</div>
@endsection

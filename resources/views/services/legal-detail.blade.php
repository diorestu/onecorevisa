@extends('layouts.app')
@section('content')
@php($t = fn ($en, $id) => \App\Support\SiteLanguage::text($en, $id, $lang))
<div class="service-profile container">
    <nav class="service-breadcrumbs" aria-label="{{ $t('Breadcrumb', 'Jejak Navigasi') }}">
        <ol>
            <li><a href="{{ route('home', ['lang' => $lang]) }}">{{ $t('Home', 'Beranda') }}</a></li>
            <li><a href="{{ route('services.show', ['service' => 'company-formation', 'lang' => $lang]) }}">{{ $t('Legal Services', 'Layanan Legal') }}</a></li>
            <li aria-current="page">{{ $serviceLine['title'] }}</li>
        </ol>
    </nav>
    <div class="service-reading-layout">
        <article class="service-reading-column">
            <header class="service-profile-header">
                <x-icon :name="$serviceLine['legalIcon']" class="legal-service-icon" />
                <p class="section-label">{{ $serviceLine['group'] === 'corporate' ? $t('Corporate & Business Solutions', 'Solusi Korporasi & Bisnis') : $t('Company Formation & Licensing', 'Pendirian & Perizinan Usaha') }}</p>
                <h1 id="service-page-title">{{ $serviceLine['title'] }}</h1>
                <p class="service-profile-intro">{{ $serviceLine['summary'] }}</p>
                <button class="button primary service-mobile-enquiry" type="button" data-consultation="{{ $serviceLine['title'] }}"><x-icon name="chat" class="cta-icon" />{{ $t('Request A Quote', 'Minta Penawaran') }}</button>
            </header>
            @if(empty($serviceLine['included']) && !empty($serviceLine['lengthOfStay']))
            <section class="service-profile-section" aria-labelledby="company-overview-title">
                <h2 id="company-overview-title">{{ $t('Company Overview', 'Ringkasan Perusahaan') }}</h2>
                <dl class="service-summary-facts">
                    <div><dt>{{ $t('Business Status', 'Status Usaha') }}</dt><dd>{{ $serviceLine['lengthOfStay'] }}</dd></div>
                    <div><dt>{{ $t('Processing Time', 'Waktu Proses') }}</dt><dd>{{ $serviceLine['processingTime'] }}</dd></div>
                    <div><dt>{{ $t('Registration Validity', 'Masa Berlaku Pendaftaran') }}</dt><dd>{{ $serviceLine['visaValidity'] }}</dd></div>
                </dl>
            </section>
            <section class="service-profile-section service-inclusions" aria-labelledby="company-activities-title">
                <h2 id="company-activities-title">{{ $t('Company Activities', 'Kegiatan Perusahaan') }}</h2>
                <ul>@foreach($serviceLine['whatsAllowed'] as $activity)<li>{{ $activity }}</li>@endforeach</ul>
            </section>
            <section class="service-profile-section service-inclusions" aria-labelledby="company-conditions-title">
                <h2 id="company-conditions-title">{{ $t('Company Conditions', 'Ketentuan Perusahaan') }}</h2>
                <ul>@foreach($serviceLine['whatsNotAllowed'] as $condition)<li>{{ $condition }}</li>@endforeach</ul>
            </section>
            @endif
            @if(!empty($serviceLine['included']))
            <section class="service-profile-section service-inclusions" id="service-inclusions" aria-labelledby="service-inclusions-title">
                <h2 id="service-inclusions-title"><x-icon name="check-circle" class="service-heading-icon" />{{ $t("What's Included", 'Cakupan Layanan') }}</h2>
                <ul>@foreach($serviceLine['included'] as $included)<li>{{ $included }}</li>@endforeach</ul>
            </section>
            @endif
            @if(!empty($serviceLine['documentRequirements']))
            <section class="service-profile-section service-documents" id="service-documents" aria-labelledby="service-documents-title">
                <h2 id="service-documents-title"><x-icon name="document" class="service-heading-icon" />{{ $t('Document Requirements', 'Persyaratan Dokumen') }}</h2>
                <ol>@foreach($serviceLine['documentRequirements'] as $document)<li>{{ $document }}</li>@endforeach</ol>
            </section>
            @endif
            <a class="text-link service-back-link service-profile-back" href="{{ route('services.show', ['service' => 'company-formation', 'lang' => $lang]) }}"><x-icon name="chevron-left" />{{ $t('Back To Legal Services', 'Kembali Ke Layanan Legal') }}</a>
        </article>
        @include('services.consultation')
    </div>
</div>
@endsection

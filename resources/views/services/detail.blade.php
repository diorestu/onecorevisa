@extends('layouts.app')
@section('content')
@php($t = fn ($en, $id) => $lang === 'id' ? $id : $en)
<section class="service-detail-hero service-line-hero container" aria-labelledby="service-page-title">
    <a class="text-link service-back-link" href="{{ route('services.show', $categorySlug) }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m14 6-6 6 6 6"/></svg>{{ $t('Back To', 'Kembali Ke') }} {{ $t($categoryDetail['name'], $categoryDetail['title_id']) }}</a>
    <p class="section-label">{{ $serviceLine['code'] }}</p>
    <h1 id="service-page-title">{{ $serviceLine['title'] }}</h1>
    <p class="service-detail-intro">{{ $serviceLine['whatsAllowed'][0] }}</p>
    <button class="button primary" type="button" data-consultation="{{ $serviceLine['title'] }}">{{ $t('Request A Quote', 'Minta Penawaran') }}</button>
</section>
<section class="service-overview container" aria-labelledby="service-overview-title">
    <h2 id="service-overview-title">{{ $t('Service Overview', 'Ringkasan Layanan') }}</h2>
    <dl class="service-facts">
        <div><dt>{{ $t($serviceLine['category'] === 'company' ? 'Business Status' : 'Length Of Stay', $serviceLine['category'] === 'company' ? 'Status Usaha' : 'Lama Tinggal') }}</dt><dd>{{ $serviceLine['lengthOfStay'] }}</dd></div>
        <div><dt>{{ $t('Processing Time', 'Waktu Proses') }}</dt><dd>{{ $serviceLine['processingTime'] }}</dd></div>
        <div><dt>{{ $t('Validity', 'Masa Berlaku') }}</dt><dd>{{ $serviceLine['visaValidity'] }}</dd></div>
        <div><dt>{{ $t('Service Fee', 'Biaya Layanan') }}</dt><dd>{{ $t('Request A Quote', 'Minta Penawaran') }}</dd></div>
    </dl>
</section>
<section class="service-detail-body container" aria-label="{{ $t('Activities And Restrictions', 'Aktivitas Dan Pembatasan') }}">
    <div><h2>{{ $t('Allowed Activities', 'Aktivitas Yang Diizinkan') }}</h2><ul>@foreach($serviceLine['whatsAllowed'] as $activity)<li>{{ $activity }}</li>@endforeach</ul></div>
    <div><h2>{{ $t('Restrictions', 'Pembatasan') }}</h2><ul>@foreach($serviceLine['whatsNotAllowed'] as $activity)<li>{{ $activity }}</li>@endforeach</ul></div>
</section>
<section class="service-requirements container" aria-labelledby="service-documents-title">
    <div><p class="section-label">{{ $t('Before You Apply', 'Sebelum Mengajukan') }}</p><h2 id="service-documents-title">{{ $t('Document Requirements', 'Persyaratan Dokumen') }}</h2></div>
    <ol>@foreach($serviceLine['documentRequirements'] as $document)<li>{{ $document }}</li>@endforeach</ol>
</section>
<section class="service-enquiry container" aria-labelledby="service-enquiry-title">
    <div><h2 id="service-enquiry-title">{{ $t('Plan Your Application', 'Rencanakan Pengajuan Anda') }}</h2><p>{{ $t('Discuss your nationality, timeline, and documents with our team. We will confirm the requirements and provide a quote for your application.', 'Diskusikan kewarganegaraan, waktu, dan dokumen Anda bersama tim kami. Kami akan mengonfirmasi persyaratan dan memberikan penawaran untuk pengajuan Anda.') }}</p></div>
    <button class="button primary" type="button" data-consultation="{{ $serviceLine['title'] }}">{{ $t('Discuss This Service', 'Konsultasi Layanan Ini') }}</button>
</section>
@endsection

@extends('layouts.app')
@section('content')
@php($t = fn ($en, $id) => $lang === 'id' ? $id : $en)
<section class="service-category-hero" aria-labelledby="service-page-title">
    <img class="service-category-image" src="{{ asset('assets/images/index/' . $serviceDetail['image']) }}" alt="" width="1600" height="1000" fetchpriority="high">
    <div class="container service-category-content">
        <a class="text-link service-back-link" href="{{ route('home') }}#services-section"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m14 6-6 6 6 6"/></svg>{{ $t('Back To Services', 'Kembali Ke Layanan') }}</a>
        <p class="section-label">{{ $t('Our Services', 'Layanan Kami') }}</p>
        <h1 id="service-page-title">{{ $t($serviceDetail['name'], $serviceDetail['title_id']) }}</h1>
        <p class="service-detail-intro">{{ $t(...$serviceDetail['intro']) }}</p>
        <button class="button primary" type="button" data-consultation="{{ $serviceDetail['name'] }}">{{ $t('Discuss Your Options', 'Diskusikan Pilihan Anda') }}</button>
    </div>
</section>
<section class="service-lines-section container" aria-labelledby="service-lines-title">
    <div class="section-head"><div><p class="section-label">{{ count($categoryServices) }} {{ $t('services', 'layanan') }}</p><h2 id="service-lines-title">{{ $t('Find The Right Service', 'Temukan Layanan Yang Tepat') }}</h2></div><p>{{ $t('Compare the options, then view the requirements for your plans.', 'Bandingkan pilihan, lalu lihat persyaratan sesuai rencana Anda.') }}</p></div>
    <div class="service-lines">
        @foreach($categoryServices as $item)
        @php($lineCategory = collect($serviceCategories)->search(fn ($category) => $category['sourceCategory'] === $item['category']))
        <article class="service-line">
            <div class="service-line-media">
                <img class="service-line-thumbnail" src="{{ asset('assets/images/index/' . $item['thumbnail']) }}" alt="" width="640" height="360" loading="lazy" decoding="async">
            </div>
            <div class="service-line-content">
                <p class="section-label">{{ $item['code'] }}</p>
                <h3><a href="{{ route('services.detail', [$lineCategory, $item['id']]) }}">{{ $item['title'] }}</a></h3>
                <dl class="service-line-facts">
                    <div><dt>{{ $t($item['category'] === 'company' ? 'Business Status' : 'Length Of Stay', $item['category'] === 'company' ? 'Status Usaha' : 'Lama Tinggal') }}</dt><dd>{{ $item['lengthOfStay'] }}</dd></div>
                    <div><dt>{{ $t('Processing Time', 'Waktu Proses') }}</dt><dd>{{ $item['processingTime'] }}</dd></div>
                </dl>
                <a class="text-link" href="{{ route('services.detail', [$lineCategory, $item['id']]) }}" aria-label="{{ $t('View Details', 'Lihat Detail') }}: {{ $item['title'] }}">{{ $t('View Details', 'Lihat Detail') }} <x-icon name="arrow-right" class="cta-icon" /></a>
            </div>
        </article>
        @endforeach
    </div>
    <p class="service-detail-note">{{ $t('Our team will confirm eligibility, document requirements, fees, and processing estimates before you proceed.', 'Tim kami akan mengonfirmasi kelayakan, persyaratan dokumen, biaya, dan estimasi waktu proses sebelum Anda melanjutkan.') }}</p>
</section>
@endsection

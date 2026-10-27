@extends('layouts.app')
@section('content')
@php($t = fn ($en, $id) => \App\Support\SiteLanguage::text($en, $id, $lang))
<div class="legal-catalog container">
    <header class="legal-catalog-header">
        <p class="section-label">OneCoreVisa</p>
        <h1 id="service-page-title">{{ $t('Legal Services', 'Layanan Legal') }}</h1>
        <p>{{ $t(...$serviceDetail['intro']) }}</p>
        <nav class="service-section-nav" aria-label="{{ $t('Service Categories', 'Kategori Layanan') }}">
            <a href="#company-formation">{{ $t('Company Formation & Licensing', 'Pendirian & Perizinan Usaha') }}</a>
            <a href="#corporate-solutions">{{ $t('Corporate & Business Solutions', 'Solusi Korporasi & Bisnis') }}</a>
        </nav>
    </header>
    @foreach(['formation' => ['company-formation', 'Company Formation & Licensing', 'Pendirian & Perizinan Usaha'], 'corporate' => ['corporate-solutions', 'Corporate & Business Solutions', 'Solusi Korporasi & Bisnis']] as $group => [$anchor, $en, $id])
    <section class="legal-service-group" id="{{ $anchor }}" aria-labelledby="{{ $anchor }}-title">
        <div class="section-head"><h2 id="{{ $anchor }}-title">{{ $t($en, $id) }}</h2></div>
        <div class="legal-services-grid">
            @foreach(array_filter($categoryServices, fn ($item) => $item['group'] === $group) as $item)
            @php($pricing = config('service_pricing.'.$item['id']))
            <article class="legal-service-card">
                <x-icon :name="$item['legalIcon']" class="legal-service-icon" />
                <h3><a href="{{ route('services.detail', ['category' => 'company-formation', 'service' => $item['id'], 'lang' => $lang]) }}">{{ $item['title'] }}</a></h3>
                <p class="legal-service-summary">{{ $item['summary'] }}</p>
                <p class="legal-service-price">{{ $pricing ? 'Rp'.number_format($pricing['idr'], 0, ',', '.') : $t('Price upon consultation', 'Harga melalui konsultasi') }}</p>
                <a class="text-link legal-service-link" href="{{ route('services.detail', ['category' => 'company-formation', 'service' => $item['id'], 'lang' => $lang]) }}" aria-label="{{ $t('View Details', 'Lihat Detail') }}: {{ $item['title'] }}">{{ $t('View Details', 'Lihat Detail') }} <x-icon name="arrow-right" class="cta-icon" /></a>
            </article>
            @endforeach
        </div>
    </section>
    @endforeach
</div>
@endsection

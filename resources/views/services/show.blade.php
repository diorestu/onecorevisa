@extends('layouts.app')
@section('content')
@php($t = fn ($en, $id) => $lang === 'id' ? $id : $en)
<section class="service-detail-hero container" aria-labelledby="service-page-title">
    <a class="text-link" href="{{ route('home') }}#services-section">{{ $t('Back to services', 'Kembali ke layanan') }}</a>
    <div class="service-detail-grid">
        <div><h1 id="service-page-title">{{ $t($serviceDetail['name'], $serviceDetail['title_id']) }}</h1><p class="service-detail-intro">{{ $t(...$serviceDetail['intro']) }}</p><button class="button primary" type="button" data-consultation="{{ $serviceDetail['name'] }}">{{ $t('Discuss this service', 'Konsultasi layanan') }}</button></div>
        <img src="{{ asset('assets/images/index/' . $serviceDetail['image']) }}" alt="" width="640" height="800">
    </div>
</section>
<section class="service-detail-body container" aria-labelledby="service-overview-title">
    <div><h2 id="service-overview-title">{{ $t('Plan your next step', 'Rencanakan langkah berikutnya') }}</h2><p>{{ $t(...$serviceDetail['overview']) }}</p></div>
    <div><h2>{{ $t('What to discuss with us', 'Yang perlu didiskusikan') }}</h2><ul>@foreach($serviceDetail['topics'] as $topic)<li>{{ $t(...$topic) }}</li>@endforeach</ul><p class="service-detail-note">{{ $t('The available options, documents, fees, and timing will be reviewed with you before proceeding.', 'Pilihan yang tersedia, dokumen, biaya, dan waktu proses akan ditinjau bersama Anda sebelum melanjutkan.') }}</p></div>
</section>
@endsection

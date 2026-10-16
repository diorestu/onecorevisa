@php($seo = \App\Support\SiteSeo::page(get_defined_vars()))
    <title>{{ $seo['title'] }}</title>
    <meta name="description" content="{{ $seo['description'] }}">
    <link rel="canonical" href="{{ $seo['canonical'] }}">
    @foreach($seo['alternates'] as $locale => $url)
    <link rel="alternate" hreflang="{{ $locale }}" href="{{ $url }}">
    @endforeach
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="OneCoreVisa">
    <meta property="og:title" content="{{ $seo['title'] }}">
    <meta property="og:description" content="{{ $seo['description'] }}">
    <meta property="og:url" content="{{ $seo['canonical'] }}">
    <meta property="og:locale" content="{{ $lang === 'id' ? 'id_ID' : 'en_US' }}">
    <meta property="og:locale:alternate" content="{{ $lang === 'id' ? 'en_US' : 'id_ID' }}">
    <meta property="og:image" content="{{ $seo['image'] }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="OneCoreVisa - Indonesian visa and stay permit assistance">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo['title'] }}">
    <meta name="twitter:description" content="{{ $seo['description'] }}">
    <meta name="twitter:image" content="{{ $seo['image'] }}">
    <meta name="twitter:image:alt" content="OneCoreVisa - Indonesian visa and stay permit assistance">
    <link rel="icon" href="{{ asset('favicon.ico') }}?v={{ filemtime(public_path('favicon.ico')) }}" sizes="16x16 32x32 48x48">
    <link rel="icon" href="{{ asset('favicon.svg') }}?v={{ filemtime(public_path('favicon.svg')) }}" type="image/svg+xml" sizes="any">
    <link rel="icon" href="{{ asset('favicon.png') }}?v={{ filemtime(public_path('favicon.png')) }}" type="image/png" sizes="128x128">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}" sizes="180x180">
    <script type="application/ld+json">{!! json_encode($seo['graph'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) !!}</script>

@props(['lang' => 'en'])
<nav class="language-toggle" aria-label="{{ \App\Support\SiteLanguage::text('Language', 'Bahasa', $lang) }}">
    <x-icon name="globe" />
    @foreach(['id' => 'Bahasa Indonesia', 'en' => 'English'] as $locale => $label)
        @php
            $query = request()->except('lang');
            if ($locale !== 'en') $query['lang'] = $locale;
            $languageUrl = request()->getSchemeAndHttpHost().request()->getPathInfo().($query ? '?'.http_build_query($query) : '');
        @endphp
        <a href="{{ $languageUrl }}" lang="{{ $locale }}" hreflang="{{ $locale }}" aria-label="{{ $label }}" @if($lang === $locale) aria-current="true" @endif>{{ strtoupper($locale) }}</a>
    @endforeach
</nav>

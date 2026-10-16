@props(['lang' => 'en'])
<details class="language-dropdown">
    <summary aria-label="{{ \App\Support\SiteLanguage::text('Language', 'Bahasa', $lang) }}"><x-icon name="globe" /><span>{{ strtoupper($lang) }}</span><svg class="language-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg></summary>
    <nav class="language-options" aria-label="{{ \App\Support\SiteLanguage::text('Language', 'Bahasa', $lang) }}">
        @foreach(['en' => 'English', 'id' => 'Bahasa Indonesia', 'ru' => 'Русский', 'es' => 'Español'] as $locale => $label)
            <a href="{{ rtrim(url('/'), '/') . request()->getPathInfo() . ($locale === 'en' ? '' : '?lang=' . $locale) }}" lang="{{ $locale }}" hreflang="{{ $locale }}" @if($lang === $locale) aria-current="true" @endif><span>{{ $label }}</span><span class="language-code">{{ strtoupper($locale) }}</span></a>
        @endforeach
    </nav>
</details>

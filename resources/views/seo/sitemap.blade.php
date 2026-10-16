{!! '<'.'?xml version="1.0" encoding="UTF-8"?'.'>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
@foreach($pages as $page)
@foreach(['en', 'id'] as $locale)
    <url>
        <loc>{{ \App\Support\SiteSeo::url($page['path'], $locale) }}</loc>
        <xhtml:link rel="alternate" hreflang="en" href="{{ \App\Support\SiteSeo::url($page['path']) }}"/>
        <xhtml:link rel="alternate" hreflang="id" href="{{ \App\Support\SiteSeo::url($page['path'], 'id') }}"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ \App\Support\SiteSeo::url($page['path']) }}"/>
    </url>
@endforeach
@endforeach
</urlset>

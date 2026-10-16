# OneCoreVisa

> Private assistance with Indonesian visa applications, visa extensions, KITAS, KITAP, and company formation.

## Website

- [Home]({{ \App\Support\SiteSeo::url() }}): Service categories, consultation process, and contact information.
- [Bahasa Indonesia]({{ \App\Support\SiteSeo::url('/', 'id') }}): Indonesian website navigation and service summaries. Some detailed service information is in English.

## Services

@foreach($pages as $page)
@if($page['path'] !== '/')
- [{!! $page['name'] !!}]({{ \App\Support\SiteSeo::url($page['path']) }})
@endif
@endforeach

## Contact

- Email: onecorevisa@gmail.com
- WhatsApp: https://wa.me/6289672966845
- Consultation languages: English and Indonesian.

## Reading the service pages

Service detail pages describe length of stay or business status, processing estimates, validity, allowed activities, restrictions, and document requirements. Fees are quoted for each application. Confirm eligibility, current requirements, fees, and processing estimates with the team before proceeding. OneCoreVisa provides private assistance; it is not an Indonesian government immigration portal.

## Discovery

- [Sitemap]({{ \App\Support\SiteSeo::url('/sitemap.xml') }})


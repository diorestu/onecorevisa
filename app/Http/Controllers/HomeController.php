<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Support\CmsContent;
use App\Support\SiteLanguage;
use App\Support\SiteSeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    protected function getData($lang = 'en')
    {
        return app(CmsContent::class)->data($lang);
    }

    /**
     * Homepage displaying all 5 sections
     */
    public function index(Request $request)
    {
        $lang = $this->language($request);

        $data = $this->getData($lang);
        $data['lang'] = $lang;
        $data['serviceCategories'] = $this->serviceCategories();
        unset($data['serviceCategories']['company-formation']);
        $data['visaSimulatorCountries'] = config('visa_simulator.country_codes');

        return view('home', $data);
    }

    public function showService(Request $request, string $service)
    {
        $lang = $this->language($request);
        $details = app(CmsContent::class)->landingPages($lang);
        $data = $this->getData($lang);
        $data['lang'] = $lang;
        $data['serviceCategories'] = $this->serviceCategories();
        $details = array_merge($details, $data['serviceCategories']);
        abort_unless(isset($details[$service]), 404);

        $legacyServices = [
            'e-visa-voa' => ['voa-b1'],
            'single-entry-visas' => [
                'voa-b1', 'voa-extension', 'c1-tourist-visa', 'single-entry-extension', 'c2-business-visa',
                'c12-pre-investment-visa', 'c6-social-cultural-visa', 'c7-arts-music-visa',
                'c13-join-vessel-visa', 'c14-filming-visa',
                'c5-c5a-journalism-content-creator-visa',
            ],
            'multiple-entry-visas' => ['multiple-entry-d1-d2'],
        ];
        $sourceCategory = $details[$service]['sourceCategory'] ?? null;
        $data['categoryServices'] = array_values(array_filter($data['services'], fn ($item) => $sourceCategory ? $item['category'] === $sourceCategory : in_array($item['id'], $legacyServices[$service] ?? [], true)
        ));
        $serviceOrder = $details[$service]['serviceOrder'] ?? ($sourceCategory ? null : ($legacyServices[$service] ?? []));
        if ($serviceOrder) {
            $order = array_flip($serviceOrder);
            usort($data['categoryServices'], fn ($a, $b) => ($order[$a['id']] ?? PHP_INT_MAX) <=> ($order[$b['id']] ?? PHP_INT_MAX));
        }
        $data['serviceDetail'] = $details[$service];

        return view($service === 'company-formation' ? 'services.legal-index' : 'services.show', $data);
    }

    private function serviceCategories(): array
    {
        return app(CmsContent::class)->categories();
    }

    public function showServiceLine(Request $request, string $category, string $service)
    {
        $lang = $this->language($request);
        $data = $this->getData($lang);
        $data['lang'] = $lang;
        $data['serviceCategories'] = $this->serviceCategories();
        if ($category === 'visa-extensions' && $service === 'kitas-extension') {
            return redirect()->route('services.show', ['service' => 'visa-extensions', 'lang' => $lang], 301);
        }
        if ($category === 'visitor-visas' && $service === 'c13-medical-humanitarian-visa') {
            return redirect()->route('services.show', ['service' => 'single-entry-visas', 'lang' => $lang], 301);
        }

        $movedServices = [
            'multiple-entry-d1-d2' => 'visitor-visas',
            'd12-pre-investment-visa' => 'visitor-visas',
            'multiple-entry-extension' => 'visa-extensions',
            'working-kitas-extension' => 'visa-extensions',
            'investor-kitas-extension' => 'visa-extensions',
        ];
        if (isset($movedServices[$service]) && $category === $movedServices[$service]) {
            return redirect()->route('services.detail', ['category' => 'kitas', 'service' => $service, 'lang' => $lang], 301);
        }

        $categoryDetail = $data['serviceCategories'][$category] ?? null;
        abort_unless($categoryDetail, 404);
        $item = collect($data['services'])->first(fn ($item) => $item['id'] === $service && $item['category'] === $categoryDetail['sourceCategory']);
        abort_unless($item, 404);

        $data['serviceDetail'] = ['name' => $item['title'], 'title_id' => $item['title']];
        $data['serviceLine'] = $item;
        $data['servicePricing'] = app(CmsContent::class)->pricing($service);
        $data['categoryDetail'] = $categoryDetail;
        $data['categorySlug'] = $category;

        return view($item['category'] === 'company' ? 'services.legal-detail' : 'services.detail', $data);
    }

    /**
     * Switch language route
     */
    public function switchLang(Request $request, $locale)
    {
        if (! in_array($locale, SiteLanguage::LOCALES, true)) {
            return redirect()->route('home');
        }
        session(['locale' => $locale]);
        $previous = url()->previous();
        $path = parse_url($previous, PHP_URL_HOST) === $request->getHost()
            ? parse_url($previous, PHP_URL_PATH) : '/';

        return redirect()->to(url($path ?: '/').($locale === 'en' ? '' : '?lang='.$locale));
    }

    private function language(Request $request): string
    {
        $locale = $request->query('lang');

        return in_array($locale, SiteLanguage::LOCALES, true) ? $locale : 'en';
    }

    private function discoveryPages(): array
    {
        $pages = [['path' => '/', 'name' => 'OneCoreVisa']];
        $categories = $this->serviceCategories();
        foreach ($categories as $slug => $category) {
            $pages[] = ['path' => '/services/'.$slug, 'name' => $category['name']];
        }
        foreach (['e-visa-voa' => 'E-Visa VOA', 'single-entry-visas' => 'Single Entry Visas', 'multiple-entry-visas' => 'Multiple Entry Visas'] as $slug => $name) {
            $pages[] = ['path' => '/services/'.$slug, 'name' => $name];
        }
        foreach ($this->getData()['services'] as $service) {
            $categorySlug = collect($categories)->search(fn ($category) => $category['sourceCategory'] === $service['category']);
            if ($categorySlug !== false) {
                $pages[] = ['path' => '/services/'.$categorySlug.'/'.$service['id'], 'name' => $service['title']];
            }
        }

        $pages[] = ['path' => '/articles', 'name' => 'Articles & News'];
        if (Schema::hasTable('articles')) {
            foreach (Article::published()->get() as $article) {
                $pages[] = ['path' => '/articles/'.$article->slug, 'name' => $article->title()];
            }
        }

        return $pages;
    }

    public function sitemap()
    {
        return response()->view('seo.sitemap', ['pages' => $this->discoveryPages()])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function robots()
    {
        return response("User-agent: *\nAllow: /\nDisallow: /lang/\n\nSitemap: ".SiteSeo::url('/sitemap.xml')."\n")
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    public function llms()
    {
        return response()->view('seo.llms', ['pages' => $this->discoveryPages()])
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    /**
     * Submit consultation inquiry
     */
    public function submitConsultation(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'whatsapp' => 'required|string|max:50',
            'email' => 'nullable|email|max:150',
            'nationality' => 'required|string|max:100',
            'service' => 'nullable|string|max:150',
            'location' => 'nullable|string|max:150',
            'notes' => 'nullable|string|max:1000',
        ]);

        $name = urlencode($validated['name']);
        $whatsapp = urlencode($validated['whatsapp']);
        $email = urlencode($validated['email'] ?? '-');
        $nationality = urlencode($validated['nationality']);
        $service = urlencode($validated['service'] ?? 'Konsultasi Visa & PT PMA');
        $location = urlencode($validated['location'] ?? 'Indonesia');
        $notes = urlencode($validated['notes'] ?? 'Mohon informasi estimasi biaya dan persyaratan.');

        $text = "Halo OneCoreVisa,%0A%0ASaya ingin konsultasi layanan:%0A- Nama: {$name}%0A- WhatsApp: {$whatsapp}%0A- Email: {$email}%0A- Kewarganegaraan: {$nationality}%0A- Layanan: {$service}%0A- Lokasi: {$location}%0A- Catatan: {$notes}%0A%0AMohon bantuan konsultan hukum OneCoreVisa. Terima kasih!";

        $number = app(CmsContent::class)->contact($this->language($request))['whatsapp'];
        $whatsappUrl = "https://wa.me/{$number}?text={$text}";

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Consultation inquiry received!',
                'whatsapp_url' => $whatsappUrl,
            ]);
        }

        return redirect($whatsappUrl);
    }
}

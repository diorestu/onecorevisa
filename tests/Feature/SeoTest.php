<?php

namespace Tests\Feature;

use Tests\TestCase;

class SeoTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['seo.url' => 'https://onecorevisa.example']);
    }

    private function document(string $html): \DOMXPath
    {
        $document = new \DOMDocument;
        @$document->loadHTML($html);

        return new \DOMXPath($document);
    }

    public function test_home_has_canonical_social_metadata_and_real_business_schema(): void
    {
        $response = $this->get('/?utm_source=test');
        $response->assertOk();
        $xpath = $this->document($response->getContent());
        $this->assertSame('https://onecorevisa.example/', $xpath->evaluate('string(//link[@rel="canonical"]/@href)'));
        $this->assertSame('1200', $xpath->evaluate('string(//meta[@property="og:image:width"]/@content)'));
        $this->assertSame('summary_large_image', $xpath->evaluate('string(//meta[@name="twitter:card"]/@content)'));
        $this->assertSame('https://onecorevisa.example/assets/images/onecore-og.png', $xpath->evaluate('string(//meta[@property="og:image"]/@content)'));
        $schema = json_decode($xpath->evaluate('string(//script[@type="application/ld+json"])'), true, flags: JSON_THROW_ON_ERROR);
        $types = array_column($schema['@graph'], '@type');
        $this->assertContains('Organization', $types);
        $this->assertContains('WebSite', $types);
        $this->assertNotContains('AggregateRating', $types);
        $this->assertStringNotContainsString('Sunset Visa Agency', $response->getContent());
    }

    public function test_service_descriptions_are_specific_and_schema_matches_visible_content(): void
    {
        $category = $this->get('/services/kitas')->assertOk();
        $detail = $this->get('/services/kitas/investor-kitas-e28a')->assertOk();
        $categoryXpath = $this->document($category->getContent());
        $detailXpath = $this->document($detail->getContent());
        $this->assertNotSame($categoryXpath->evaluate('string(//meta[@name="description"]/@content)'), $detailXpath->evaluate('string(//meta[@name="description"]/@content)'));
        $schema = json_decode($detailXpath->evaluate('string(//script[@type="application/ld+json"])'), true, flags: JSON_THROW_ON_ERROR);
        $service = collect($schema['@graph'])->firstWhere('@type', 'Service');
        $this->assertSame($detailXpath->evaluate('string(//h1)'), $service['name']);
        $this->assertSame('https://onecorevisa.example/services/kitas/investor-kitas-e28a', $service['url']);
        $this->assertContains('BreadcrumbList', array_column($schema['@graph'], '@type'));
    }

    public function test_locale_urls_override_session_on_every_page_and_have_reciprocal_alternates(): void
    {
        foreach (['/', '/services/kitas', '/services/kitas/investor-kitas-e28a'] as $path) {
            foreach (['en', 'id'] as $locale) {
                $response = $this->withSession(['locale' => $locale === 'en' ? 'id' : 'en'])->get($path.'?lang='.$locale);
                $response->assertOk()->assertSee('<html lang="'.$locale.'">', false);
                $xpath = $this->document($response->getContent());
                $url = 'https://onecorevisa.example'.$path;
                $this->assertSame($url.($locale === 'id' ? '?lang=id' : ''), $xpath->evaluate('string(//link[@rel="canonical"]/@href)'));
                $this->assertSame($url, $xpath->evaluate('string(//link[@hreflang="en"]/@href)'));
                $this->assertSame($url.'?lang=id', $xpath->evaluate('string(//link[@hreflang="id"]/@href)'));
            }
        }
    }

    public function test_sitemap_contains_only_public_pages_and_their_urls_render(): void
    {
        $response = $this->get('/sitemap.xml')->assertOk()->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
        $xml = simplexml_load_string($response->getContent());
        $urls = array_map('strval', iterator_to_array($xml->xpath('//*[local-name()="loc"]')));
        $this->assertGreaterThan(60, count($urls));
        $this->assertCount(count($urls), array_unique($urls));
        foreach ($urls as $url) {
            $this->assertStringStartsWith('https://onecorevisa.example/', $url);
            $path = substr($url, strlen('https://onecorevisa.example'));
            $page = $this->get($path)->assertOk();
            $xpath = $this->document($page->getContent());
            $this->assertSame($url, $xpath->evaluate('string(//link[@rel="canonical"]/@href)'));
        }
        $this->assertStringNotContainsString('/lang/', $response->getContent());
        $this->assertStringNotContainsString('/consultation', $response->getContent());
    }

    public function test_discovery_files_use_configured_domain_and_current_catalog(): void
    {
        $this->get('/robots.txt')->assertOk()->assertSee('Sitemap: https://onecorevisa.example/sitemap.xml');
        $this->get('/llms.txt')->assertOk()->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
            ->assertSee('# OneCoreVisa')->assertSee('https://onecorevisa.example/services/kitas/investor-kitas-e28a')
            ->assertSee('onecorevisa@gmail.com')->assertDontSee('Marcus Lindqvist');
    }

    public function test_invalid_locale_query_does_not_break_service_pages(): void
    {
        $this->get('/services/kitas?lang[]=id')->assertOk();
        $this->get('/services/kitas?lang=unsupported')->assertOk();
    }

    public function test_indonesian_navigation_keeps_language_and_switches_on_the_same_page(): void
    {
        foreach (['/', '/services/kitas', '/services/kitas/investor-kitas-e28a'] as $path) {
            $response = $this->get($path.'?lang=id')->assertOk();
            $xpath = $this->document($response->getContent());
            foreach ($xpath->query('//a[not(@lang) and (starts-with(@href, "http://localhost/services/") or @class="brand")]') as $link) {
                $this->assertStringContainsString('lang=id', $link->getAttribute('href'));
            }
            $this->assertSame('http://localhost'.$path, $xpath->evaluate('string(//a[@lang="en"]/@href)'));
        }
    }

    public function test_legacy_language_switch_redirects_to_explicit_locale_url(): void
    {
        $this->from('/services/kitas')->get('/lang/id')->assertRedirect('/services/kitas?lang=id');
        $this->from('/services/kitas?lang=id')->get('/lang/en')->assertRedirect('/services/kitas');
        $this->from('https://external.example/other')->get('/lang/id')->assertRedirect('/?lang=id');
    }

    public function test_russian_and_spanish_locales_keep_navigation_and_canonical_urls(): void
    {
        foreach (['ru' => 'Связаться с нами', 'es' => 'Contáctanos'] as $locale => $contactLabel) {
            foreach (['/', '/services/kitas', '/services/kitas/investor-kitas-e28a'] as $path) {
                $response = $this->get($path.'?lang='.$locale)->assertOk();
                $response->assertSee('<html lang="'.$locale.'">', false)->assertSee($contactLabel)
                    ->assertSee('class="language-dropdown"', false)->assertSee('@onecorevisa');
                $xpath = $this->document($response->getContent());
                $this->assertSame('http://localhost'.$path.'?lang='.$locale, $xpath->evaluate('string(//a[@lang="'.$locale.'"]/@href)'));
                $this->assertSame('https://onecorevisa.example'.$path.'?lang='.$locale, $xpath->evaluate('string(//link[@rel="canonical"]/@href)'));
            }
            $this->from('/services/kitas')->get('/lang/'.$locale)->assertRedirect('/services/kitas?lang='.$locale);
        }
    }

    public function test_brand_assets_have_expected_dimensions_and_ico_sizes(): void
    {
        foreach (['favicon.png' => [128, 128], 'apple-touch-icon.png' => [180, 180], 'assets/images/onecore-og.png' => [1200, 630]] as $path => $dimensions) {
            $size = getimagesize(public_path($path));
            $this->assertSame($dimensions, [$size[0], $size[1]]);
        }
        $header = unpack('vreserved/vtype/vcount', file_get_contents(public_path('favicon.ico'), length: 6));
        $this->assertSame(['reserved' => 0, 'type' => 1, 'count' => 3], $header);
        $this->assertStringContainsString('data:image/png;base64,', file_get_contents(public_path('favicon.svg')));
    }
}

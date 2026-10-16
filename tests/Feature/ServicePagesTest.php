<?php

namespace Tests\Feature;

use Tests\TestCase;

class ServicePagesTest extends TestCase
{
    private const CATEGORIES = [
        'visitor-visas' => ['voa-b1', 'c1-tourist-visa', 'c2-business-visa', 'c12-pre-investment-visa', 'c6-social-cultural-visa', 'c7-arts-music-visa', 'c13-medical-humanitarian-visa', 'multiple-entry-d1-d2'],
        'visa-extensions' => ['voa-extension', 'single-entry-extension', 'multiple-entry-extension', 'kitas-extension'],
        'kitas' => ['investor-kitas-e28a', 'working-kitas-e23', 'digital-nomad-e33g', 'retirement-kitas-e33e', 'dependent-kitas-e31', 'spouse-kitas', 'student-visa-e30a', 'ex-wni-visa-e32a', 'golden-visa'],
        'kitap' => ['investor-kitap', 'working-kitap', 'family-kitap', 'retirement-kitap'],
        'company-formation' => ['pma-company', 'pt-local-company'],
    ];

    public function test_home_links_to_featured_services_legality_and_whatsapp(): void
    {
        $response = $this->get('/');
        $response->assertOk()->assertSee('One Step Solution')->assertSee('class="whatsapp-float"', false)->assertSee('https://wa.me/6289672966845');
        foreach (['visa-extensions', 'e-visa-voa', 'single-entry-visas', 'multiple-entry-visas', 'company-formation'] as $category) {
            $response->assertSee('/services/'.$category);
        }
        $this->assertSame(4, substr_count($response->getContent(), 'class="service-feature-card"'));
        $this->assertSame(12, substr_count($response->getContent(), 'class="service-feature-check"'));
        $response->assertDontSee('class="service-toggle"', false);
        $response->assertSee('Visa &amp; KITAS Services', false)->assertSee('Legality Services');
        $response->assertViewHas('serviceCategories', fn ($items) => count($items) === 4 && !isset($items['company-formation']));
        $response->assertSee('id="visa-simulator"', false)->assertSee('href="#visa-simulator"', false)
            ->assertDontSee('id="preference-section"', false)->assertDontSee('#preference-section', false);
    }

    public function test_all_document_services_have_category_links_and_complete_detail_pages(): void
    {
        foreach (self::CATEGORIES as $category => $services) {
            $response = $this->get('/services/'.$category);
            $response->assertOk()->assertViewHas('categoryServices', fn ($items) => count($items) === count($services));
            foreach ($services as $service) {
                $response->assertSee('/services/'.$category.'/'.$service);
                $detail = $this->get('/services/'.$category.'/'.$service);
                $detail->assertOk()->assertSee('Document Requirements')->assertSee('Processing Time')->assertSee('Allowed Activities')->assertSee('Restrictions')->assertSee('Request A Quote')->assertDontSee('Competitive / Inquire');
            }
        }
    }

    public function test_unknown_and_wrong_category_services_return_404(): void
    {
        $this->get('/services/unknown')->assertNotFound();
        $this->get('/services/kitas/voa-b1')->assertNotFound();
        $this->get('/services/visitor-visas/unknown')->assertNotFound();
    }

    public function test_simulator_uses_an_explicit_official_country_list_and_existing_services(): void
    {
        $countries = config('visa_simulator.country_codes');
        $this->assertCount(97, $countries);
        $this->assertSame($countries, array_values(array_unique($countries)));
        $this->assertContains('AU', $countries);
        $this->assertContains('RU', $countries);
        $this->assertNotContains('AF', $countries);
        $this->assertNotContains('ID', $countries);
        foreach ($countries as $code) {
            $this->assertFileExists(public_path('assets/images/flags/'.strtolower($code).'.svg'));
        }

        foreach (['en', 'id', 'ru', 'es'] as $locale) {
            $response = $this->get('/?lang='.$locale)->assertOk();
            $response->assertViewHas('visaSimulatorCountries', $countries)
                ->assertSee('id="visa-simulator"', false)->assertSee(config('visa_simulator.source_url'))
                ->assertSee('data-service-code="VOA"', false)
                ->assertSee('data-service-code="C1"', false)
                ->assertSee('data-service-code="D1"', false)
                ->assertSee('data-service-code="DIGITAL-NOMAD"', false)
                ->assertDontSee('id="simulator-consult"', false);
        }
    }

    public function test_existing_category_urls_remain_available(): void
    {
        foreach (['visa-extensions', 'e-visa-voa', 'single-entry-visas', 'multiple-entry-visas'] as $service) {
            $this->get('/services/'.$service)->assertOk();
        }
    }

    public function test_published_starting_prices_are_only_rendered_on_service_details(): void
    {
        $this->get('/')->assertOk()->assertDontSee('Start from')->assertDontSee('Rp3.580.000');
        foreach (self::CATEGORIES as $category => $services) {
            $this->get('/services/'.$category)->assertOk()->assertDontSee('Start from');
            foreach ($services as $service) {
                $price = config('service_pricing.'.$service);
                if (! $price) {
                    continue;
                }
                $response = $this->get('/services/'.$category.'/'.$service)->assertOk();
                $response->assertSee('Start from')->assertSee('Rp'.number_format($price['idr'], 0, ',', '.'));
                if (isset($price['usd'])) {
                    $response->assertSee('USD '.number_format($price['usd'], 0, '.', ','));
                }
            }
        }
    }

    public function test_pricing_preserves_pdf_amounts_and_does_not_reuse_extension_prices_for_new_applications(): void
    {
        $this->get('/services/visitor-visas/c1-tourist-visa')->assertOk()->assertSee('Rp3.580.000');
        $this->get('/services/visitor-visas/c12-pre-investment-visa')->assertOk()->assertSee('Start from')->assertSee('Rp5.400.000');
        $this->get('/services/kitas/working-kitas-e23')->assertOk()->assertSee('Rp18.000.000')->assertSee('USD 600')->assertSee('6-month option');
        $this->get('/services/kitas/digital-nomad-e33g')->assertOk()->assertSee('Rp17.500.000')->assertDontSee('Rp16.500.000');
        $this->get('/services/company-formation/pma-company')->assertOk()->assertSee('Rp25.000.000');
        $this->get('/services/kitas/golden-visa')->assertOk()->assertDontSee('Start from')->assertDontSee('Rp40.000.000')->assertSee('Quoted For Your Application');
        $this->get('/services/visitor-visas/voa-b1')->assertOk()->assertDontSee('Start from')->assertDontSee('Rp1.000.000');
    }

    public function test_service_consultation_preserves_specific_service_in_whatsapp(): void
    {
        $this->postJson('/consultation', [
            'name' => 'Test Customer', 'whatsapp' => '+628111111111',
            'nationality' => 'Australia', 'service' => 'Investor KITAS (E28A)',
        ])->assertOk()->assertJsonPath('success', true)
            ->assertJsonPath('whatsapp_url', fn ($url) => str_starts_with($url, 'https://wa.me/6289672966845?text=') && str_contains(urldecode($url), 'Investor KITAS (E28A)'));
    }
}

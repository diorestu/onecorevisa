<?php

namespace Tests\Feature;

use Tests\TestCase;

class ServicePagesTest extends TestCase
{
    private const CATEGORIES = [
        'visitor-visas' => ['voa-b1', 'c1-tourist-visa', 'c2-business-visa', 'c5-c5a-journalism-content-creator-visa', 'c12-pre-investment-visa', 'c6-social-cultural-visa', 'c7-arts-music-visa', 'c13-join-vessel-visa', 'c14-filming-visa'],
        'visa-extensions' => ['voa-extension', 'single-entry-extension', 'family-dependent-kitas-extension', 'retirement-kitas-extension'],
        'kitas' => ['multiple-entry-d1-d2', 'multiple-entry-extension', 'd12-pre-investment-visa', 'working-kitas-extension', 'investor-kitas-extension', 'investor-kitas-e28a', 'working-kitas-e23', 'digital-nomad-e33g', 'retirement-kitas-e33e', 'dependent-kitas-e31', 'spouse-kitas', 'student-visa-e30a', 'ex-wni-visa-e32a', 'golden-visa'],
        'kitap' => ['investor-kitap', 'working-kitap', 'family-kitap', 'retirement-kitap'],
        'company-formation' => ['pma-company', 'pt-local-company', 'cv-establishment', 'pt-local-hospitality-setup', 'pt-perorangan', 'nib-oss-process', 'oss-account-assistance', 'company-valuation', 'annual-company-report', 'company-closing-local', 'company-closing-pma', 'recruitment-hr-services', 'hr-compliance', 'payroll-outsourcing', 'accounting-tax-services', 'property-advisory', 'insurance-services', 'legal-contract-advisory', 'building-permit-pbg-slf', 'due-diligence', 'document-review'],
    ];

    public function test_home_links_to_featured_services_legality_and_whatsapp(): void
    {
        $response = $this->get('/');
        $response->assertOk()->assertSee('One Step Solution')->assertSee('class="whatsapp-float"', false)->assertSee('https://wa.me/6289672966845');
        foreach (['single-entry-visas', 'kitas', 'kitap', 'company-formation'] as $category) {
            $response->assertSee('/services/'.$category);
        }
        $this->assertSame(3, substr_count($response->getContent(), 'class="service-feature-card"'));
        $this->assertSame(9, substr_count($response->getContent(), 'class="service-feature-check"'));
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
                $detail->assertOk()->assertSee('Request A Quote')->assertDontSee('Competitive / Inquire');
                if ($category === 'company-formation') {
                    $detail->assertDontSee('Length Of Stay')->assertDontSee('Allowed Activities');
                } else {
                    $detail->assertSee('Document Requirements')->assertSee('Processing Time')->assertSee('Allowed Activities')->assertSee('Restrictions');
                }
            }
        }
    }

    public function test_unknown_and_wrong_category_services_return_404(): void
    {
        $this->get('/services/unknown')->assertNotFound();
        $this->get('/services/kitas/voa-b1')->assertNotFound();
        $this->get('/services/visitor-visas/unknown')->assertNotFound();
    }

    public function test_journalism_and_content_creator_visa_is_listed_with_supplied_details(): void
    {
        $slug = 'c5-c5a-journalism-content-creator-visa';
        $path = '/services/visitor-visas/'.$slug;
        $this->get('/services/single-entry-visas')->assertOk()->assertSee($path);
        foreach (['en', 'id'] as $lang) {
            $this->get($path.'?lang='.$lang)->assertOk()
                ->assertSee('C5/C5A - Journalism Visa & content creator visit visa (60 days)')
                ->assertSee('Rp5.875.000*')
                ->assertSee('60 Days (Extendable 2x, up to 180 days total)')
                ->assertSee('Regular: 5 - 10 Working Days • Priority: 2 - 4 Working Days')
                ->assertSee('Must be used within 90 days from the date of issuance.')
                ->assertSee('C5A does not authorize journalistic activities that require a C5 visa or additional authorization.')
                ->assertSee('C5A Content Creator Visa Application')
                ->assertSee('A portfolio or samples of your previous content.')
                ->assertSee('Full name as shown on your passport.')
                ->assertSee('Details of any brand collaborations or sponsorships, if applicable.')
                ->assertViewHas('serviceLine', fn ($item) => count($item['documentRequirements']) === 7 && count($item['additionalInformation']) === 6);
        }
        $this->get('/sitemap.xml')->assertOk()->assertSee($path);
        $this->get('/services/kitas/'.$slug)->assertNotFound();
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
                if (empty($price['options'])) {
                    $response->assertSee('Start from');
                }
                $response->assertSee('Rp'.number_format($price['idr'], 0, ',', '.'));
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
        $this->get('/services/kitas/working-kitas-e23')->assertOk()->assertSee('Rp18.000.000')->assertSee('USD 600')->assertSee('6 Months');
        $this->get('/services/kitas/digital-nomad-e33g')->assertOk()->assertSee('Rp17.500.000')->assertDontSee('Rp16.500.000');
        $this->get('/services/company-formation/pma-company')->assertOk()->assertSee('Rp25.000.000');
        $this->get('/services/kitas/golden-visa')->assertOk()->assertDontSee('Start from')->assertDontSee('Rp40.000.000')->assertSee('Quoted For Your Application');
        $this->get('/services/visitor-visas/voa-b1')->assertOk()->assertSee('Start from')->assertSee('Rp1.000.000');
    }

    public function test_single_entry_services_have_distinct_photos_and_separate_vessel_and_filming_pages(): void
    {
        $response = $this->get('/services/single-entry-visas')->assertOk()
            ->assertSee('C13 - Join Vessel Visa (60 Days)')
            ->assertSee('C14 - Filming Visa (60 Days)')
            ->assertSee('/services/visitor-visas/voa-b1')
            ->assertDontSee('/services/visitor-visas/multiple-entry-d1-d2')
            ->assertDontSee('Medical &amp; Humanitarian', false);
        $items = $response->viewData('categoryServices');
        $this->assertCount(count($items), array_unique(array_column($items, 'thumbnail')));
        foreach ($items as $item) {
            $this->assertFileExists(public_path('assets/images/index/'.$item['thumbnail']));
        }
        foreach (['c13-join-vessel-visa', 'c14-filming-visa'] as $slug) {
            $this->get('/services/visitor-visas/'.$slug)->assertOk()->assertDontSee('medical treatment');
            $this->get('/sitemap.xml')->assertOk()->assertSee('/services/visitor-visas/'.$slug);
        }
    }

    public function test_single_entry_catalog_keeps_short_visit_extensions_and_long_stay_has_unpriced_d12(): void
    {
        $response = $this->get('/services/single-entry-visas')->assertOk();
        $ids = array_column($response->viewData('categoryServices'), 'id');
        $this->assertSame([
            'voa-b1', 'voa-extension', 'c1-tourist-visa', 'single-entry-extension', 'c2-business-visa',
            'c12-pre-investment-visa', 'c6-social-cultural-visa', 'c7-arts-music-visa',
            'c13-join-vessel-visa', 'c14-filming-visa', 'c5-c5a-journalism-content-creator-visa',
        ], $ids);
        foreach (['voa-extension', 'single-entry-extension'] as $slug) {
            $response->assertSee('/services/visa-extensions/'.$slug);
            $this->get('/services/visitor-visas/'.$slug)->assertNotFound();
        }
        foreach (['en', 'id'] as $lang) {
            $this->get('/services/kitas/d12-pre-investment-visa?lang='.$lang)->assertOk()
                ->assertSee('D12 – Pre-Investment Visa')
                ->assertSee('Conducting pre-investment activities, including field surveys and feasibility studies.')
                ->assertSee('Available for 1 year or 2 years, depending on the visa option issued. Visa validity is different from the permitted length of stay per entry.')
                ->assertSee('Personal bank statement for the last 3 months, showing a minimum balance of USD 5,000 or equivalent, subject to confirmation.')
                ->assertViewHas('serviceLine', fn ($item) => count($item['documentRequirements']) === 7 && count($item['whatsAllowed']) === 4 && count($item['whatsNotAllowed']) === 4)
                ->assertViewHas('servicePricing', null)->assertDontSee('Start from');
            $this->get('/services/visa-extensions/single-entry-extension?lang='.$lang)->assertOk()->assertViewHas('servicePricing', null);
        }
        $this->get('/sitemap.xml')->assertOk()->assertSee('/services/kitas/d12-pre-investment-visa');
        $this->get('/services/kitap/d12-pre-investment-visa')->assertNotFound();
    }

    public function test_long_stay_services_use_distinct_photos_and_a_separate_category_image(): void
    {
        $response = $this->get('/services/kitas')->assertOk();
        $items = $response->viewData('categoryServices');
        $photos = array_column($items, 'thumbnail');
        $this->assertCount(count($items), array_unique($photos));
        $hashes = [];
        foreach ($photos as $photo) {
            $path = public_path('assets/images/index/'.$photo);
            $this->assertFileExists($path);
            $hashes[] = hash_file('sha256', $path);
        }
        $this->assertCount(count($items), array_unique($hashes));
        $hero = $response->viewData('serviceDetail')['image'];
        $this->assertNotContains($hero, $photos);
        $this->assertFileExists(public_path('assets/images/index/'.$hero));
    }

    public function test_multiple_entry_services_move_to_long_stay_and_old_links_redirect(): void
    {
        $moved = [
            'multiple-entry-d1-d2' => 'visitor-visas',
            'd12-pre-investment-visa' => 'visitor-visas',
            'multiple-entry-extension' => 'visa-extensions',
            'investor-kitas-extension' => 'visa-extensions',
            'working-kitas-extension' => 'visa-extensions',
        ];
        foreach (['en', 'id', 'ru', 'es'] as $lang) {
            $single = $this->get('/services/single-entry-visas?lang='.$lang)->assertOk();
            $long = $this->get('/services/kitas?lang='.$lang)->assertOk();
            foreach ($moved as $slug => $oldCategory) {
                $single->assertDontSee('/'.$slug);
                $long->assertSee('/services/kitas/'.$slug);
                $this->get('/services/'.$oldCategory.'/'.$slug.'?lang='.$lang)
                    ->assertStatus(301)->assertRedirect('/services/kitas/'.$slug.'?lang='.$lang);
                $this->get('/services/kitas/'.$slug.'?lang='.$lang)->assertOk()
                    ->assertViewHas('categorySlug', 'kitas')
                    ->assertViewHas('serviceLine', fn ($item) => $item['category'] === 'kitas');
            }
        }
        $sitemap = $this->get('/sitemap.xml')->assertOk();
        foreach ($moved as $slug => $oldCategory) {
            $sitemap->assertSee('/services/kitas/'.$slug)->assertDontSee('/services/'.$oldCategory.'/'.$slug);
        }
        $this->get('/services/kitap/multiple-entry-d1-d2')->assertNotFound();
    }

    public function test_vessel_and_filming_details_have_supplied_prices_activities_and_documents(): void
    {
        foreach (['en', 'id'] as $lang) {
            foreach (['c13-join-vessel-visa' => 2, 'c14-filming-visa' => 6] as $slug => $documentCount) {
                $response = $this->get('/services/visitor-visas/'.$slug.'?lang='.$lang)->assertOk()
                    ->assertSee('Rp5.875.000')->assertSee('3 - 7 Working Days')
                    ->assertSee('Must be used within 90 days from issuance date.')
                    ->assertSee('Conduct business activities outside the scope permitted by the visa.')
                    ->assertSee('Conduct tourism activities and visit friends or family while in Indonesia.')
                    ->assertDontSee('Confirmed during consultation');
                $this->assertCount($documentCount, $response->viewData('serviceLine')['documentRequirements']);
            }
            $this->get('/services/visitor-visas/c13-join-vessel-visa?lang='.$lang)->assertOk()
                ->assertSee('Join a vessel or other means of transportation located within Indonesian territory.')
                ->assertSee('Official letter or supporting documentation from the relevant company or government authority confirming that the applicant will join a vessel or means of transportation in Indonesia.');
            $this->get('/services/visitor-visas/c14-filming-visa?lang='.$lang)->assertOk()
                ->assertSee('Produce films, music videos, reality shows, documentaries, television programs, radio programs, and similar productions using locations in Indonesia.')
                ->assertSee('Visa application letter.')
                ->assertSee('Travel itinerary and return or onward flight ticket.')
                ->assertSee('Sponsorship or guarantee documents from the authorized guarantor.')
                ->assertSee('Filming permit or approval from the relevant Indonesian government authority.')
                ->assertSee('Additional supporting documents as required for the filming project and visa application.');
        }
    }

    public function test_extension_prices_keep_durations_and_imta_supplement_separate(): void
    {
        foreach (['en', 'id'] as $lang) {
            $this->get('/services/kitas/working-kitas-extension?lang='.$lang)
                ->assertOk()->assertSee('Rp16.000.000')->assertSee('USD 1,200')->assertSee('Rp25.000.000');
            $this->get('/services/kitas/investor-kitas-extension?lang='.$lang)
                ->assertOk()->assertSee('Rp18.900.000')->assertSee('Rp23.000.000')->assertDontSee('USD 1,200');
            foreach (['family-dependent-kitas-extension', 'retirement-kitas-extension'] as $slug) {
                $this->get('/services/visa-extensions/'.$slug.'?lang='.$lang)
                    ->assertOk()->assertDontSee('Rp16.500.000')->assertDontSee('Start from');
            }
        }
        $this->get('/services/visa-extensions/kitas-extension?lang=id')
            ->assertRedirect('/services/visa-extensions?lang=id');
        $this->get('/services/visitor-visas/c13-medical-humanitarian-visa')
            ->assertRedirect('/services/single-entry-visas?lang=en');
        $this->get('/services/kitas/kitas-extension')->assertNotFound();
    }

    public function test_kitas_duration_prices_and_unpriced_services_follow_supplied_catalog(): void
    {
        foreach (['en', 'id'] as $lang) {
            foreach ([
                'investor-kitas-e28a' => ['Rp19.000.000', 'Rp25.000.000'],
                'working-kitas-e23' => ['Rp18.000.000', 'USD 600', 'Rp30.000.000', 'USD 1,200', 'Rp33.000.000', 'USD 2,400', '15 - 45 Working Days'],
                'dependent-kitas-e31' => ['Rp20.000.000', 'Rp25.000.000'],
                'spouse-kitas' => ['Rp20.000.000', 'Rp25.000.000'],
                'student-visa-e30a' => ['Rp17.500.000'],
            ] as $slug => $values) {
                $response = $this->get('/services/kitas/'.$slug.'?lang='.$lang)->assertOk();
                foreach ($values as $value) {
                    $response->assertSee($value);
                }
            }
            foreach (['kitas/ex-wni-visa-e32a', 'kitas/golden-visa', 'kitap/working-kitap'] as $path) {
                $this->get('/services/'.$path.'?lang='.$lang)->assertOk()->assertDontSee('Start from')
                    ->assertViewHas('servicePricing', null);
            }
        }
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

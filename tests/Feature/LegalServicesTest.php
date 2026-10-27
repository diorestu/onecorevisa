<?php

namespace Tests\Feature;

use Tests\TestCase;

class LegalServicesTest extends TestCase
{
    public function test_legal_catalog_uses_icons_and_keeps_company_and_corporate_services_separate(): void
    {
        $response = $this->get('/services/company-formation')->assertOk()
            ->assertSee('Legal Services')->assertSee('Corporate &amp; Business Solutions', false)
            ->assertSee('class="legal-services-grid"', false)
            ->assertDontSee('service-line-thumbnail')->assertDontSee('service-category-image');
        $this->assertSame(21, substr_count($response->getContent(), 'class="legal-service-card"'));
        $response->assertSee('/services/company-formation/pma-company')
            ->assertSee('/services/company-formation/pt-local-company');
    }

    public function test_published_legal_prices_and_inclusions_are_available_in_both_languages(): void
    {
        foreach (['en', 'id'] as $lang) {
            foreach ([
                'cv-establishment' => ['Rp10.000.000', 'Business Name Registration'],
                'pt-local-company' => ['Rp18.000.000', 'Company Name Registration'],
                'pt-local-hospitality-setup' => ['Rp20.000.000', 'Hospitality Business Licensing Guidance'],
                'pt-perorangan' => ['Rp5.000.000', 'Statement of Establishment'],
                'nib-oss-process' => ['Rp4.000.000', 'NIB Application &amp; Issuance'],
                'oss-account-assistance' => ['Rp1.500.000', 'Account Recovery Guidance'],
            ] as $slug => [$price, $included]) {
                $this->get('/services/company-formation/'.$slug.'?lang='.$lang)->assertOk()
                    ->assertSee($price)->assertSee($included, false)->assertSee('service-inclusions', false)
                    ->assertDontSee('Length Of Stay')->assertDontSee('Restrictions');
            }
        }
    }

    public function test_corporate_services_have_consultation_pricing_and_supplied_requirements(): void
    {
        foreach ([
            'company-valuation', 'annual-company-report', 'company-closing-local', 'company-closing-pma',
            'recruitment-hr-services', 'hr-compliance', 'payroll-outsourcing', 'accounting-tax-services',
            'property-advisory', 'insurance-services', 'legal-contract-advisory',
            'building-permit-pbg-slf', 'due-diligence', 'document-review',
        ] as $slug) {
            $this->get('/services/company-formation/'.$slug)->assertOk()
                ->assertViewHas('servicePricing', null)->assertSee('Quoted For Your Application')
                ->assertDontSee('Start from');
            $this->get('/sitemap.xml')->assertOk()->assertSee('/services/company-formation/'.$slug);
            $this->get('/services/kitas/'.$slug)->assertNotFound();
        }
        foreach (['building-permit-pbg-slf' => 10, 'due-diligence' => 11, 'document-review' => 9] as $slug => $count) {
            $response = $this->get('/services/company-formation/'.$slug)->assertOk()->assertSee('Document Requirements');
            $this->assertCount($count, $response->viewData('serviceLine')['documentRequirements']);
        }
    }
}

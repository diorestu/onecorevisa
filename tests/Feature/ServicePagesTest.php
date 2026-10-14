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

    public function test_home_links_to_all_document_categories_and_whatsapp(): void
    {
        $response = $this->get('/');
        $response->assertOk()->assertSee('One Step Solution')->assertSee('class="whatsapp-float"', false)->assertSee('https://wa.me/6289672966845');
        foreach (self::CATEGORIES as $category => $services) {
            $response->assertSee('/services/'.$category);
        }
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

    public function test_existing_category_urls_remain_available(): void
    {
        foreach (['visa-extensions', 'e-visa-voa', 'single-entry-visas', 'multiple-entry-visas'] as $service) {
            $this->get('/services/'.$service)->assertOk();
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

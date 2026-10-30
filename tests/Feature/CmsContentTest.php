<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\CopyText;
use App\Models\PageContent;
use App\Models\Service;
use App\Services\ImportWebsiteContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmsContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_import_preserves_edits_and_service_deletions_on_repeat(): void
    {
        app(ImportWebsiteContent::class)->run();
        $service = Service::where('slug', 'c13-join-vessel-visa')->firstOrFail();
        $this->assertSame('60 Days', $service->translations['en']['lengthOfStay']);
        $copy = CopyText::where('key', hash('sha256', 'Visa assistance for'))->firstOrFail();
        $copy->update(['translations' => ['en' => 'Updated heading', 'id' => 'Judul baru']]);
        $service->delete();
        $count = CopyText::count();
        app(ImportWebsiteContent::class)->run();
        $this->assertSame($count, CopyText::count());
        $this->assertSame('Updated heading', $copy->fresh()->translations['en']);
        $this->assertNull(Service::where('slug', $service->slug)->first());
    }

    public function test_public_website_reads_edited_copy_content_services_and_prices(): void
    {
        app(ImportWebsiteContent::class)->run();
        CopyText::where('key', hash('sha256', 'Visa assistance for'))->update(['translations' => ['en' => 'Managed heading', 'id' => 'Judul terkelola']]);
        $service = Service::where('slug', 'voa-b1')->firstOrFail();
        $translations = $service->translations;
        $translations['en']['title'] = 'Managed VOA';
        $service->update(['translations' => $translations, 'pricing' => ['idr' => 1234567]]);
        $content = PageContent::where('key', 'contact')->firstOrFail();
        $content->update(['translations' => ['en' => ['whatsapp' => '6281234567890', 'email' => 'hello@onecore.test'], 'id' => ['whatsapp' => '6281234567890', 'email' => 'halo@onecore.test']]]);
        $this->get('/')->assertOk()->assertSee('Managed heading')->assertSee('hello@onecore.test');
        $this->get('/?lang=id')->assertOk()->assertSee('Judul terkelola')->assertSee('halo@onecore.test');
        $this->get('/services/visitor-visas/voa-b1')->assertOk()->assertSee('Managed VOA')->assertSee('Rp1.234.567');
        $service->update(['status' => 'draft']);
        $this->get('/services/visitor-visas/voa-b1')->assertNotFound();
        $this->get('/services/visitor-visas/voa-b1?lang=ru')->assertNotFound();
        $this->get('/sitemap.xml')->assertDontSee('/services/visitor-visas/voa-b1<');
    }

    public function test_empty_highlights_stay_empty_and_inactive_categories_have_no_home_links(): void
    {
        app(ImportWebsiteContent::class)->run();
        $page = PageContent::where('key', 'serviceHighlights')->firstOrFail();
        $page->update(['translations' => ['en' => [], 'id' => []]]);
        $response = $this->get('/')->assertOk();
        $this->assertSame(0, substr_count($response->getContent(), 'class="service-feature-card"'));
        Category::where('slug', 'company-formation')->update(['is_active' => false]);
        $this->get('/')->assertOk()->assertDontSee('href="http://localhost/services/company-formation', false);
        $this->get('/services/company-formation')->assertNotFound();
    }
}

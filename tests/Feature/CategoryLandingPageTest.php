<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\PageContent;
use App\Models\User;
use App\Services\ImportWebsiteContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryLandingPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        app(ImportWebsiteContent::class)->run();
        $this->actingAs(User::factory()->create(['is_admin' => true]));
    }

    public function test_category_list_reports_actual_homepage_locations_and_inactive_categories(): void
    {
        Category::where('slug', 'kitap')->update(['is_active' => false]);
        $response = $this->get('/admin/categories')->assertOk()->assertSee('Landing page');
        $response->assertViewHas('landingPageLocations', function ($locations) {
            $this->assertSame(['Sorotan layanan (EN / ID)', 'Form konsultasi'], $locations['kitas']);
            $this->assertSame(['Form konsultasi'], $locations['visitor-visas']);
            $this->assertSame(['Navigasi dan footer'], $locations['company-formation']);
            $this->assertArrayNotHasKey('kitap', $locations);

            return true;
        });
        $response->assertSee('Tidak tampil')->assertSee('Kategori nonaktif');
        $this->get('/admin/services')->assertDontSee('<th>Landing page</th>', false);
    }

    public function test_featured_locations_follow_current_content_and_language(): void
    {
        $content = PageContent::where('key', 'serviceHighlights')->firstOrFail();
        $translations = $content->translations;
        $translations['en'] = [$translations['en'][1]];
        $translations['id'] = [$translations['id'][2]];
        $content->update(['translations' => $translations]);
        $this->get('/admin/categories')->assertViewHas('landingPageLocations', function ($locations) {
            $this->assertSame(['Sorotan layanan (EN)', 'Form konsultasi'], $locations['kitas']);
            $this->assertSame(['Sorotan layanan (ID)', 'Form konsultasi'], $locations['kitap']);

            return true;
        });
    }

    public function test_article_category_only_appears_if_its_article_is_in_homepage_latest_three(): void
    {
        $categories = [];
        foreach (range(0, 3) as $index) {
            $categories[$index] = Category::create(['slug' => 'news-'.$index, 'type' => 'article', 'translations' => ['en' => ['title' => 'News '.$index], 'id' => ['title' => 'Berita '.$index]]]);
            Article::create(['slug' => 'story-'.$index, 'category_id' => $categories[$index]->id, 'status' => 'published', 'published_at' => now()->subMinutes($index + 1), 'translations' => ['en' => ['title' => 'Story', 'body' => 'Text'], 'id' => ['title' => 'Berita', 'body' => 'Teks']]]);
        }
        $this->get('/admin/categories')->assertViewHas('landingPageLocations', function ($locations) {
            $this->assertSame(['Berita terbaru'], $locations['news-0']);
            $this->assertArrayNotHasKey('news-3', $locations);

            return true;
        });
        $categories[0]->update(['is_active' => false]);
        $this->get('/admin/categories')->assertViewHas('landingPageLocations', function ($locations) {
            $this->assertArrayNotHasKey('news-0', $locations);
            $this->assertSame(['Berita terbaru'], $locations['news-3']);

            return true;
        });
    }
}

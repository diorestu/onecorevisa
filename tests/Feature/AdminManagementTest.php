<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\CopyText;
use App\Models\PageContent;
use App\Models\Service;
use App\Models\User;
use App\Services\ImportWebsiteContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        app(ImportWebsiteContent::class)->run();
        $this->actingAs(User::factory()->create(['is_admin' => true]));
    }

    public function test_all_management_lists_and_existing_edit_forms_render(): void
    {
        foreach (['copywriting' => CopyText::first()->id, 'content' => PageContent::where('key', 'process')->first()->id, 'articles' => null, 'categories' => Category::first()->id, 'services' => Service::first()->id] as $module => $id) {
            $this->get('/admin/'.$module)->assertOk();
            $this->get('/admin/'.$module.'/'.($id ? $id.'/edit' : 'create'))->assertOk();
        }
        $this->get('/admin/services/create')->assertOk();
        $this->get('/admin/categories/create')->assertOk();
        $this->get('/admin/unknown')->assertNotFound();
    }

    public function test_copy_update_is_validated_and_reaches_both_public_languages(): void
    {
        $copy = CopyText::where('key', hash('sha256', 'Visa assistance for'))->firstOrFail();
        $this->put('/admin/copywriting/'.$copy->id, ['translations' => ['en' => '', 'id' => 'Judul']])->assertSessionHasErrors('translations.en');
        $this->put('/admin/copywriting/'.$copy->id, ['translations' => ['en' => 'Editor heading', 'id' => 'Judul editor']])->assertRedirect('/admin/copywriting');
        $this->get('/')->assertSee('Editor heading');
        $this->get('/?lang=id')->assertSee('Judul editor');
    }

    public function test_category_references_and_imported_slug_are_protected(): void
    {
        $category = Category::where('slug', 'visitor-visas')->firstOrFail();
        $this->delete('/admin/categories/'.$category->id)->assertSessionHasErrors('category');
        $this->assertNotNull($category->fresh());
        $this->put('/admin/categories/'.$category->id, ['slug' => 'changed', 'type' => 'service', 'translations' => $category->translations, 'is_active' => 1])->assertSessionHasErrors('slug');
    }

    public function test_admin_can_create_and_update_service_with_price_options(): void
    {
        $category = Category::where('slug', 'visitor-visas')->firstOrFail();
        $payload = ['category_id' => $category->id, 'slug' => 'new-visa', 'status' => 'published', 'sort_order' => 90,
            'translations' => ['en' => ['title' => 'New visa', 'whatsAllowed' => ['Visit Indonesia']], 'id' => ['title' => 'Visa baru', 'whatsAllowed' => ['Kunjungi Indonesia']]],
            'details' => ['code' => 'New', 'group' => 'formation', 'legalIcon' => 'building'],
            'pricing' => ['idr' => 1234000, 'options' => [['idr' => 1234000, 'label' => ['One month', 'Satu bulan']]]]];
        $this->post('/admin/services', $payload)->assertSessionHasNoErrors()->assertRedirect('/admin/services');
        $service = Service::where('slug', 'new-visa')->firstOrFail();
        $this->get('/services/visitor-visas/new-visa')->assertOk()->assertSee('New visa')->assertSee('Rp1.234.000');
        $payload['pricing']['idr'] = -1;
        $this->put('/admin/services/'.$service->id, $payload)->assertSessionHasErrors('pricing.idr');
        $this->delete('/admin/services/'.$service->id)->assertRedirect('/admin/services');
        $this->get('/services/visitor-visas/new-visa')->assertNotFound();
    }

    public function test_article_category_types_and_image_upload_are_validated(): void
    {
        Storage::fake('public');
        $payload = ['slug' => 'test-news', 'status' => 'draft', 'translations' => ['en' => ['title' => 'News', 'body' => '## News'], 'id' => ['title' => 'Berita', 'body' => '## Berita']]];
        $this->post('/admin/articles', $payload + ['category_id' => Category::where('type', 'service')->first()->id])->assertSessionHasErrors('category_id');
        $this->post('/admin/articles', $payload + ['image_upload' => UploadedFile::fake()->create('evil.svg', 1, 'image/svg+xml')])->assertSessionHasErrors('image_upload');
        $this->post('/admin/articles', $payload + ['image_upload' => UploadedFile::fake()->image('cover.png')])->assertSessionHasNoErrors()->assertRedirect('/admin/articles');
        $article = Article::firstOrFail();
        Storage::disk('public')->assertExists($article->image);
        $this->get('/admin/articles/'.$article->id.'/edit')->assertOk()->assertSee('cover');
    }

    public function test_every_management_endpoint_is_admin_only(): void
    {
        $this->actingAs(User::factory()->create());
        foreach (['copywriting', 'content', 'articles', 'categories', 'services'] as $module) {
            $this->get('/admin/'.$module)->assertForbidden();
            $this->post('/admin/'.$module, [])->assertForbidden();
        }
    }

    public function test_optional_prices_empty_repeaters_and_new_categories_remain_editable(): void
    {
        $service = Service::where('slug', 'voa-b1')->firstOrFail();
        $this->put('/admin/services/'.$service->id, ['slug' => $service->slug, 'category_id' => $service->category_id, 'status' => 'published', 'translations' => $service->translations, 'pricing' => ['basis' => ['', '']], 'details' => $service->details])->assertSessionHasNoErrors();
        $this->get('/services/visitor-visas/voa-b1')->assertOk();
        $page = PageContent::where('key', 'process')->firstOrFail();
        $page->update(['translations' => ['en' => [], 'id' => []]]);
        $this->get('/admin/content/'.$page->id.'/edit')->assertOk()->assertSee('translations[en][__ROW_', false)->assertSee('timeline', false);
        $this->post('/admin/categories', ['slug' => 'new-category', 'type' => 'service', 'is_active' => 1, 'translations' => ['en' => ['title' => 'New category'], 'id' => ['title' => 'Kategori baru']]])->assertSessionHasNoErrors();
        $this->get('/services/new-category')->assertOk()->assertSee('New category');
    }

    public function test_nested_content_upload_is_stored_and_rendered(): void
    {
        Storage::fake('public');
        $page = PageContent::where('key', 'serviceHighlights')->firstOrFail();
        $this->put('/admin/content/'.$page->id, ['translations' => $page->translations, 'uploads' => ['translations__en__0__image' => UploadedFile::fake()->image('highlight.png')]])->assertSessionHasNoErrors();
        $image = $page->fresh()->translations['en'][0]['image'];
        $this->assertStringStartsWith('cms/', $image);
        Storage::disk('public')->assertExists($image);
        $this->get('/')->assertSee('/storage/'.$image);
    }

    public function test_every_imported_service_can_be_saved_without_validation_or_public_render_errors(): void
    {
        foreach (Service::with('category')->get() as $service) {
            $this->put('/admin/services/'.$service->id, ['slug' => $service->slug, 'category_id' => $service->category_id, 'status' => $service->status, 'translations' => $service->translations, 'details' => $service->details, 'pricing' => $service->pricing])->assertSessionHasNoErrors();
            $this->get('/services/'.$service->category->slug.'/'.$service->slug)->assertOk();
        }
    }

    public function test_upload_after_removing_first_repeater_row_keeps_surviving_content(): void
    {
        Storage::fake('public');
        $page = PageContent::where('key', 'serviceHighlights')->firstOrFail();
        $translations = $page->translations;
        unset($translations['en'][0],$translations['id'][0]);
        $this->put('/admin/content/'.$page->id, ['translations' => $translations, 'uploads' => ['translations__en__1__image' => UploadedFile::fake()->image('changed.png')]])->assertSessionHasNoErrors();
        $saved = $page->fresh()->translations;
        $this->assertCount(2, $saved['en']);
        $this->assertSame('kitas', $saved['en'][0]['slug']);
        $this->assertStringStartsWith('cms/', $saved['en'][0]['image']);
        $this->get('/')->assertOk();
    }
}

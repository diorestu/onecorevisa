<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Services\ImportWebsiteContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlesTest extends TestCase
{
    use RefreshDatabase;

    private function article(array $attributes = []): Article
    {
        return Article::create(array_replace(['slug' => 'visa-news', 'status' => 'published', 'published_at' => now()->subMinute(), 'translations' => ['en' => ['title' => 'Visa news', 'excerpt' => 'Latest information', 'body' => "## Public news\n\n**Updated** text.\n\n<script>alert(1)</script>\n\n[bad](javascript:alert(1))"], 'id' => ['title' => 'Berita visa', 'excerpt' => 'Informasi terbaru', 'body' => '## Berita publik']]], $attributes));
    }

    public function test_published_articles_render_both_languages_and_strip_unsafe_markup(): void
    {
        app(ImportWebsiteContent::class)->run();
        $this->article();
        $this->get('/articles/visa-news')->assertOk()->assertSee('<h2>Public news</h2>', false)->assertDontSee('<script>alert', false)->assertDontSee('href="javascript:', false)->assertSee('Visa news | OneCoreVisa');
        $this->get('/articles/visa-news?lang=id')->assertOk()->assertSee('Berita publik')->assertSee('Berita visa | OneCoreVisa')->assertDontSee('hreflang="ru"', false);
        $this->get('/articles/visa-news?lang=ru')->assertNotFound();
        $this->get('/articles')->assertOk()->assertSee('Visa news')->assertSee('class="site-header is-solid"', false)->assertSee(route('home', ['lang' => 'en']).'#services-section');
        $this->get('/')->assertSee('/articles/visa-news');
        $this->get('/sitemap.xml')->assertSee('/articles/visa-news');
    }

    public function test_drafts_future_publications_and_inactive_categories_are_private(): void
    {
        app(ImportWebsiteContent::class)->run();
        $draft = $this->article(['slug' => 'draft-news', 'status' => 'draft']);
        $this->article(['slug' => 'future-news', 'published_at' => now()->addDay()]);
        $category = Category::create(['slug' => 'inactive-news', 'type' => 'article', 'is_active' => false, 'translations' => ['en' => ['title' => 'Inactive'], 'id' => ['title' => 'Nonaktif']]]);
        $this->article(['slug' => 'hidden-category', 'category_id' => $category->id]);
        foreach (['draft-news', 'future-news', 'hidden-category'] as $slug) {
            $this->get('/articles/'.$slug)->assertNotFound();
            $this->get('/sitemap.xml')->assertDontSee('/articles/'.$slug);
        }
        $this->get('/admin/articles/'.$draft->id.'/preview')->assertRedirect('/admin/login');
        $this->actingAs(User::factory()->create())->get('/admin/articles/'.$draft->id.'/preview')->assertForbidden();
        $this->actingAs(User::factory()->create(['is_admin' => true]))->get('/admin/articles/'.$draft->id.'/preview')->assertOk()->assertSee('Pratinjau');
    }

    public function test_article_filter_only_lists_selected_category(): void
    {
        app(ImportWebsiteContent::class)->run();
        $category = Category::create(['slug' => 'news', 'type' => 'article', 'translations' => ['en' => ['title' => 'News'], 'id' => ['title' => 'Berita']]]);
        $this->article(['category_id' => $category->id]);
        $this->article(['slug' => 'other-news', 'translations' => ['en' => ['title' => 'Other story', 'body' => 'Other'], 'id' => ['title' => 'Lain', 'body' => 'Lain']]]);
        $this->get('/articles?category=news')->assertOk()->assertSee('Visa news')->assertDontSee('Other story');
    }
}

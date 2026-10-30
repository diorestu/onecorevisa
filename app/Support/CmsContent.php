<?php

namespace App\Support;

use App\Models\Article;
use App\Models\Category;
use App\Models\CopyText;
use App\Models\PageContent;
use App\Models\Service;
use Illuminate\Support\Facades\Schema;

class CmsContent
{
    private function remember(string $key, callable $callback): mixed
    {
        $key = 'cms.'.$key;
        $attributes = request()->attributes;
        if (! $attributes->has($key)) {
            $attributes->set($key, $callback());
        }

        return $attributes->get($key);
    }

    public function ready(): bool
    {
        return $this->remember('ready', fn () => Schema::hasTable('page_contents') && PageContent::where('key', 'initialized')->exists());
    }

    private function pages(): array
    {
        return $this->remember('pages', fn () => $this->ready() ? PageContent::all()->keyBy('key')->toArray() : []);
    }

    public function page(string $key, string $locale, array $default = []): array
    {
        return $this->pages()[$key]['translations'][$locale === 'id' ? 'id' : 'en'] ?? $default;
    }

    public function copy(string $en, string $id, string $locale): string
    {
        if (! in_array($locale, ['en', 'id'], true) || ! $this->ready()) {
            return $locale === 'id' ? $id : $en;
        }
        $texts = $this->remember('copy', fn () => CopyText::all()->keyBy('key')->toArray());

        return $texts[hash('sha256', $en)]['translations'][$locale] ?? ($locale === 'id' ? $id : $en);
    }

    public function categories(): array
    {
        if (! $this->ready()) {
            return app(LegacyContent::class)->categories();
        }

        return $this->remember('categories', function () {
            $result = [];
            foreach (Category::where('type', 'service')->where('is_active', true)->orderBy('sort_order')->get() as $category) {
                $en = $category->translations['en'];
                $id = $category->translations['id'];
                $details = array_diff_key($category->details ?? [], ['serviceOrder' => true]);
                $result[$category->slug] = array_replace(['image' => 'service-business.webp'], array_filter($details, fn ($v) => $v !== '' && $v !== null), [
                    'name' => $en['title'], 'title_id' => $id['title'], 'sourceCategory' => $category->source_key,
                    'intro' => [$en['description'] ?? '', $id['description'] ?? ''],
                    'benefits' => array_map(fn ($value, $index) => [$value, $id['benefits'][$index] ?? $value], $en['benefits'] ?? [], array_keys($en['benefits'] ?? [])),
                ]);
            }

            return $result;
        });
    }

    public function landingPages(string $locale = 'en'): array
    {
        $pages = app(LegacyContent::class)->landingPages();
        if (! $this->ready()) {
            return $pages;
        }
        foreach ($pages as $slug => &$landing) {
            $en = $this->page('landing:'.$slug, 'en');
            $id = $this->page('landing:'.$slug, 'id');
            if (! $en || ! $id) {
                continue;
            }
            $landing = array_replace($landing, ['name' => $en['title'], 'title_id' => $id['title'], 'image' => $locale === 'id' ? $id['image'] : $en['image'], 'intro' => [$en['intro'], $id['intro']], 'overview' => [$en['overview'], $id['overview']], 'topics' => array_map(fn ($text, $i) => [$text, $id['topics'][$i] ?? $text], $en['topics'], array_keys($en['topics']))]);
        }
        unset($landing);

        return $pages;
    }

    public function data(string $locale = 'en'): array
    {
        $locale = $locale === 'id' ? 'id' : 'en';
        if (! $this->ready()) {
            return app(LegacyContent::class)->data($locale);
        }

        return $this->remember('data.'.$locale, function () use ($locale) {
            $services = Service::with('category')->where('status', 'published')->whereHas('category', fn ($q) => $q->where('is_active', true))->orderBy('sort_order')->get();
            $result = ['services' => [], 'categories' => []];
            foreach ($services as $service) {
                $item = array_replace(array_filter($service->details ?? [], fn ($v) => $v !== '' && $v !== null), $service->translations[$locale] ?? $service->translations['en']);
                $result['services'][] = array_replace([
                    'code' => '', 'summary' => '', 'lengthOfStay' => '', 'processingTime' => '', 'visaValidity' => '',
                    'whatsAllowed' => [''], 'whatsNotAllowed' => [], 'documentRequirements' => [], 'included' => [],
                    'group' => 'formation', 'legalIcon' => 'building', 'thumbnail' => 'service-business.webp',
                    'price' => $locale === 'id' ? 'Minta Penawaran' : 'Request A Quote',
                ], $item, ['id' => $service->slug, 'category' => $service->category->source_key]);
            }
            foreach ($this->categories() as $category) {
                $result['categories'][] = ['id' => $category['sourceCategory'], 'title' => $locale === 'id' ? $category['title_id'] : $category['name'], 'subtitle' => '', 'icon' => 'fa-passport'];
            }
            foreach (['process', 'faqs', 'testimonials'] as $key) {
                $result[$key] = $this->page($key, $locale);
            }

            return $result;
        });
    }

    public function homepage(string $locale): array
    {
        $defaults = app(LegacyContent::class)->homepage();
        if (! $this->ready()) {
            return $defaults;
        }
        foreach ($defaults as $key => $value) {
            $en = $this->page($key, 'en');
            $id = $this->page($key, 'id');
            if ($key === 'serviceHighlights') {
                $defaults[$key] = array_map(function ($item, $index) use ($id, $locale) {
                    $other = $id[$index] ?? $item;

                    return array_replace($locale === 'id' ? $other : $item, ['title' => [$item['title'], $other['title']], 'description' => [$item['description'], $other['description']],
                        'benefits' => array_map(fn ($text, $i) => [$text, $other['benefits'][$i] ?? $text], $item['benefits'], array_keys($item['benefits']))]);
                }, $en, array_keys($en));
            } else {
                $defaults[$key] = array_map(fn ($item, $i) => [$item['title'], $id[$i]['title'] ?? $item['title'], $item['description'], $id[$i]['description'] ?? $item['description']], $en, array_keys($en));
            }
        }
        $allowed = array_merge(array_keys($this->categories()), ['e-visa-voa', 'single-entry-visas', 'multiple-entry-visas']);
        $defaults['serviceHighlights'] = array_values(array_filter($defaults['serviceHighlights'], fn ($item) => in_array($item['slug'], $allowed, true)));

        return $defaults;
    }

    public function pricing(string $slug): ?array
    {
        if (! $this->ready()) {
            return config('service_pricing.'.$slug);
        }
        $prices = $this->remember('prices', fn () => Service::all()->pluck('pricing', 'slug')->all());
        $pricing = $prices[$slug] ?? null;

        return $pricing && (isset($pricing['idr']) || ! empty($pricing['options'])) ? $pricing : null;
    }

    public function landingPageCategoryLocations(): array
    {
        $categories = $this->categories();
        $featuredLocales = [];
        foreach (['en', 'id'] as $locale) {
            foreach ($this->homepage($locale)['serviceHighlights'] as $highlight) {
                if (isset($categories[$highlight['slug']])) {
                    $featuredLocales[$highlight['slug']][$locale] = strtoupper($locale);
                }
            }
        }

        $locations = [];
        foreach ($categories as $slug => $category) {
            if (isset($featuredLocales[$slug])) {
                $locations[$slug][] = 'Sorotan layanan ('.implode(' / ', $featuredLocales[$slug]).')';
            }
            $locations[$slug][] = $slug === 'company-formation' ? 'Navigasi dan footer' : 'Form konsultasi';
        }
        foreach ($this->latestArticles() as $article) {
            if ($article->category) {
                $locations[$article->category->slug] = ['Berita terbaru'];
            }
        }

        return $locations;
    }

    public function contact(string $locale = 'en'): array
    {
        return array_replace(['whatsapp' => '6289672966845', 'email' => 'onecorevisa@gmail.com', 'instagram_url' => config('social.instagram_url'), 'instagram_label' => '@onecorevisa'], $this->page('contact', $locale));
    }

    public function latestArticles()
    {
        return Schema::hasTable('articles') ? Article::published()->with('category')->latest('published_at')->limit(3)->get() : collect();
    }

    public static function image(?string $path, string $directory = 'assets/images/index/'): string
    {
        return str_starts_with($path ?? '', 'cms/') ? asset('storage/'.$path) : asset($directory.$path);
    }
}

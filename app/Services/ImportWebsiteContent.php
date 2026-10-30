<?php

namespace App\Services;

use App\Models\Category;
use App\Models\CopyText;
use App\Models\PageContent;
use App\Models\Service;
use App\Support\LegacyContent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportWebsiteContent
{
    public function run(): void
    {
        DB::transaction(function () {
            $legacy = app(LegacyContent::class);
            $english = $legacy->data('en');
            $indonesian = $legacy->data('id');
            foreach ($legacy->categories() as $slug => $category) {
                $index = array_search($slug, array_keys($legacy->categories()));
                $translations = [];
                foreach (['en' => 0, 'id' => 1] as $locale => $i) {
                    $translations[$locale] = [
                        'title' => $category[$i ? 'title_id' : 'name'], 'description' => $category['intro'][$i],
                        'benefits' => array_map(fn ($pair) => $pair[$i], $category['benefits']),
                    ];
                }
                Category::firstOrCreate(['slug' => $slug], ['type' => 'service', 'source_key' => $category['sourceCategory'], 'translations' => $translations, 'details' => array_diff_key($category, array_flip(['name', 'title_id', 'intro', 'benefits', 'sourceCategory'])), 'sort_order' => $index]);
            }
            $idServices = collect($indonesian['services'])->keyBy('id');
            foreach ($english['services'] as $index => $service) {
                $category = Category::where('source_key', $service['category'])->firstOrFail();
                $categoryOrder = array_search($service['id'], $category->details['serviceOrder'] ?? [], true);
                $details = array_intersect_key($service, array_flip(['code', 'icon', 'thumbnail', 'group', 'legalIcon']));
                $trans = fn ($item) => array_diff_key($item, array_flip(['id', 'category', 'code', 'icon', 'thumbnail', 'group', 'legalIcon']));
                Service::withTrashed()->firstOrCreate(['slug' => $service['id']], [
                    'category_id' => $category->id, 'translations' => ['en' => $trans($service), 'id' => $trans($idServices[$service['id']])],
                    'details' => $details, 'pricing' => config('service_pricing.'.$service['id']), 'sort_order' => $categoryOrder === false ? $index : $categoryOrder, 'status' => 'published',
                ]);
            }
            foreach (['process' => 'Langkah pengajuan', 'faqs' => 'Pertanyaan umum'] as $key => $label) {
                if (isset($english[$key])) {
                    $this->page($key, $label, $english[$key], $indonesian[$key]);
                }
            }
            foreach ($legacy->homepage() as $key => $items) {
                $values = [];
                foreach (['en' => 0, 'id' => 1] as $locale => $i) {
                    $values[$locale] = array_map(fn ($item) => $key === 'serviceHighlights' ? [
                        'slug' => $item['slug'], 'title' => $item['title'][$i], 'image' => $item['image'], 'description' => $item['description'][$i], 'benefits' => array_map(fn ($pair) => $pair[$i], $item['benefits']),
                    ] : ['title' => $item[$i], 'description' => $item[$i + 2]], $items);
                }
                $this->page($key, $key === 'serviceHighlights' ? 'Sorotan layanan beranda' : 'Jenis visa beranda', $values['en'], $values['id']);
            }
            $contact = ['whatsapp' => '6289672966845', 'email' => 'onecorevisa@gmail.com', 'instagram_url' => config('social.instagram_url'), 'instagram_label' => '@onecorevisa'];
            $this->page('contact', 'Informasi kontak', $contact, $contact);
            $this->page('hero', 'Gambar dan identitas hero', ['brand' => 'OneCore (One Step Solution)', 'image' => 'turquoise-cliffs-hero.png'], ['brand' => 'OneCore (One Step Solution)', 'image' => 'turquoise-cliffs-hero.png']);
            foreach ($legacy->landingPages() as $slug => $landing) {
                $values = [];
                foreach (['en' => 0, 'id' => 1] as $locale => $i) {
                    $values[$locale] = [
                        'title' => $landing[$i ? 'title_id' : 'name'], 'image' => $landing['image'], 'intro' => $landing['intro'][$i], 'overview' => $landing['overview'][$i], 'topics' => array_map(fn ($pair) => $pair[$i], $landing['topics']),
                    ];
                }
                $this->page('landing:'.$slug, $landing['name'], $values['en'], $values['id']);
            }
            $this->importCopy();
            $this->page('initialized', 'Initialization marker', [], []);
        });
    }

    private function page(string $key, string $label, array $en, array $id): void
    {
        PageContent::firstOrCreate(['key' => $key], ['group' => 'website', 'label' => $label, 'translations' => compact('en', 'id')]);
    }

    private function importCopy(): void
    {
        foreach (File::allFiles(resource_path('views')) as $file) {
            if (str_contains($file->getPathname(), '/admin/') || str_contains($file->getPathname(), '/components/admin/')) {
                continue;
            }
            $tokens = token_get_all('<?php '.$file->getContents());
            foreach ($tokens as $i => $token) {
                if (! is_array($token) || $token[0] !== T_VARIABLE || $token[1] !== '$t') {
                    continue;
                }
                $args = [];
                $cursor = $i + 1;
                while (isset($tokens[$cursor]) && is_array($tokens[$cursor]) && $tokens[$cursor][0] === T_WHITESPACE) {
                    $cursor++;
                }
                if (($tokens[$cursor++] ?? null) !== '(') {
                    continue;
                }
                while (isset($tokens[$cursor]) && count($args) < 2) {
                    $part = $tokens[$cursor++];
                    if (is_array($part) && $part[0] === T_WHITESPACE) {
                        continue;
                    }
                    if ($part === ',') {
                        continue;
                    }
                    if (! is_array($part) || $part[0] !== T_CONSTANT_ENCAPSED_STRING) {
                        break;
                    }
                    $quoted = $part[1];
                    $args[] = $quoted[0] === "'" ? str_replace(["\\'", '\\\\'], ["'", '\\'], substr($quoted, 1, -1)) : stripcslashes(substr($quoted, 1, -1));
                }
                if (count($args) !== 2) {
                    continue;
                }
                CopyText::firstOrCreate(['key' => hash('sha256', $args[0])], ['group' => str_replace('.blade.php', '', $file->getRelativePathname()), 'label' => mb_substr($args[0], 0, 200), 'translations' => ['en' => $args[0], 'id' => $args[1]]]);
            }
        }
    }
}

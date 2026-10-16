<?php

namespace App\Support;

use Illuminate\Support\Str;

class SiteSeo
{
    public static function url(string $path = '/', string $lang = 'en'): string
    {
        return rtrim(config('seo.url'), '/').'/'.ltrim($path, '/').($lang === 'en' ? '' : '?lang='.$lang);
    }

    public static function page(array $data): array
    {
        $lang = $data['lang'] ?? 'en';
        $id = $lang === 'id';
        $detail = $data['serviceDetail'] ?? null;
        $line = $data['serviceLine'] ?? null;
        $title = $detail
            ? SiteLanguage::text($detail['name'], $detail['title_id'], $lang).' | OneCoreVisa'
            : SiteLanguage::text('Indonesia Visa, KITAS & KITAP Assistance', 'Bantuan Visa Indonesia, KITAS & KITAP', $lang).' | OneCoreVisa';
        $description = $line
            ? $line['title'].': '.$line['whatsAllowed'][0]
            : ($detail ? $detail['intro'][$id ? 1 : 0] : ($id
                ? 'Bantuan pengajuan visa Indonesia, perpanjangan visa, KITAS, KITAP, dan pendirian perusahaan. Diskusikan persyaratan dan rencana Anda bersama OneCoreVisa.'
                : 'Indonesian visa applications, visa extensions, KITAS, KITAP, and company formation assistance. Discuss requirements and your plans with OneCoreVisa.'));
        $description = Str::limit($description, 157);
        $path = request()->getPathInfo();
        $canonical = self::url($path, $lang);
        $home = self::url();
        $organizationId = $home.'#organization';
        $websiteId = $home.'#website';
        $graph = [
            [
                '@type' => 'Organization', '@id' => $organizationId,
                'name' => 'OneCoreVisa', 'url' => $home,
                'logo' => self::url('/assets/images/onecore-logo.png'),
                'email' => 'onecorevisa@gmail.com', 'telephone' => '+62 896-7296-6845',
                'contactPoint' => [
                    '@type' => 'ContactPoint', 'contactType' => 'customer service',
                    'telephone' => '+62 896-7296-6845', 'availableLanguage' => ['English', 'Indonesian'],
                ],
            ],
            [
                '@type' => 'WebSite', '@id' => $websiteId, 'name' => 'OneCoreVisa',
                'url' => $home, 'publisher' => ['@id' => $organizationId], 'inLanguage' => ['en', 'id'],
            ],
            [
                '@type' => $detail && ! $line ? 'CollectionPage' : 'WebPage',
                '@id' => $canonical.'#webpage', 'url' => $canonical, 'name' => $title,
                'description' => $description, 'inLanguage' => $lang,
                'isPartOf' => ['@id' => $websiteId], 'about' => ['@id' => $organizationId],
            ],
        ];
        if ($detail) {
            $crumbs = [['@type' => 'ListItem', 'position' => 1, 'name' => $id ? 'Beranda' : 'Home', 'item' => self::url('/', $lang)]];
            if ($line) {
                $crumbs[] = [
                    '@type' => 'ListItem', 'position' => 2,
                    'name' => $id ? $data['categoryDetail']['title_id'] : $data['categoryDetail']['name'],
                    'item' => self::url('/services/'.$data['categorySlug'], $lang),
                ];
                $graph[] = [
                    '@type' => 'Service', '@id' => $canonical.'#service',
                    'name' => $line['title'], 'description' => $line['whatsAllowed'][0],
                    'url' => $canonical, 'provider' => ['@id' => $organizationId],
                    'areaServed' => ['@type' => 'Country', 'name' => 'Indonesia'],
                ];
            }
            $crumbs[] = [
                '@type' => 'ListItem', 'position' => count($crumbs) + 1,
                'name' => $id ? $detail['title_id'] : $detail['name'], 'item' => $canonical,
            ];
            $graph[] = ['@type' => 'BreadcrumbList', 'itemListElement' => $crumbs];
        }

        return compact('title', 'description', 'canonical', 'lang') + [
            'alternates' => ['en' => self::url($path), 'id' => self::url($path, 'id'), 'ru' => self::url($path, 'ru'), 'es' => self::url($path, 'es'), 'x-default' => self::url($path)],
            'image' => self::url('/assets/images/onecore-og.png'),
            'graph' => ['@context' => 'https://schema.org', '@graph' => $graph],
        ];
    }
}

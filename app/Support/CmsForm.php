<?php

namespace App\Support;

class CmsForm
{
    public static function text(string $label, string $type = 'text', bool $required = false): array
    {
        return compact('label', 'type', 'required');
    }

    public static function object(string $label, array $fields): array
    {
        return ['label' => $label, 'type' => 'object', 'fields' => $fields];
    }

    public static function list(string $label, array $item): array
    {
        return ['label' => $label, 'type' => 'list', 'item' => $item];
    }

    public static function locales(array $fields): array
    {
        return self::object('Terjemahan', ['en' => self::object('English (EN)', $fields), 'id' => self::object('Bahasa Indonesia (ID)', $fields)]);
    }

    public static function icons(): array
    {
        return ['building' => 'Gedung', 'globe' => 'Global', 'home' => 'Rumah', 'briefcase' => 'Bisnis', 'document' => 'Dokumen', 'users' => 'Tim', 'shield' => 'Perlindungan', 'calculator' => 'Keuangan', 'building-close' => 'Penutupan perusahaan', 'chart' => 'Grafik', 'document-search' => 'Peninjauan dokumen', 'id-card' => 'Identitas', 'key' => 'Akses', 'scales' => 'Hukum', 'search' => 'Pencarian'];
    }

    public static function schema(string $module, mixed $record): array
    {
        $title = self::text('Judul', 'text', true);
        if ($module === 'copywriting') {
            return self::object('', ['translations' => self::object('', ['en' => self::text('English (EN)', 'textarea', true), 'id' => self::text('Bahasa Indonesia (ID)', 'textarea', true)])]);
        }
        if ($module === 'content') {
            if (str_starts_with($record->key, 'landing:')) {
                return self::object('', ['translations' => self::locales([
                    'title' => $title, 'image' => self::text('Gambar', 'image'), 'intro' => self::text('Pengantar', 'textarea', true), 'overview' => self::text('Ringkasan', 'textarea', true), 'topics' => self::list('Topik konsultasi', self::text('Topik')),
                ])]);
            }
            $fields = match ($record->key) {
                'contact' => ['whatsapp' => self::text('Nomor WhatsApp (kode negara, tanpa +)', 'text', true), 'email' => self::text('Email', 'text', true), 'instagram_url' => self::text('URL Instagram'), 'instagram_label' => self::text('Nama Instagram')],
                'hero' => ['brand' => self::text('Identitas hero', 'text', true), 'image' => self::text('Gambar hero', 'image')],
                'process' => ['step' => self::text('Nomor tahap'), 'title' => $title, 'timeline' => self::text('Label tahap', 'text', true), 'desc' => self::text('Deskripsi', 'textarea', true)],
                'faqs' => ['q' => self::text('Pertanyaan', 'textarea', true), 'a' => self::text('Jawaban', 'textarea', true)],
                'serviceHighlights' => ['slug' => self::text('Slug tujuan kategori', 'text', true), 'title' => $title, 'image' => self::text('Gambar', 'image'), 'description' => self::text('Deskripsi', 'textarea'), 'benefits' => self::list('Manfaat', self::text('Manfaat'))],
                'visaTypes' => ['title' => $title, 'description' => self::text('Deskripsi', 'textarea')],
                default => [],
            };
            $localized = self::locales($fields);
            if (in_array($record->key, ['process', 'faqs', 'serviceHighlights', 'visaTypes'], true)) {
                foreach (['en', 'id'] as $locale) {
                    $localized['fields'][$locale] = self::list($locale === 'en' ? 'English (EN)' : 'Bahasa Indonesia (ID)', self::object('', $fields));
                }
            }

            return self::object('', ['translations' => $localized]);
        }
        if ($module === 'categories') {
            return self::object('', ['translations' => self::locales(['title' => $title, 'description' => self::text('Deskripsi', 'textarea'), 'benefits' => self::list('Manfaat', self::text('Manfaat'))]), 'details' => self::object('Tampilan kategori', ['image' => self::text('Gambar', 'image')])]);
        }
        if ($module === 'articles') {
            return self::object('', ['translations' => self::locales(['title' => $title, 'excerpt' => self::text('Ringkasan', 'textarea'), 'body' => self::text('Isi artikel', 'markdown', true), 'image_alt' => self::text('Deskripsi gambar'), 'seo_title' => self::text('Judul SEO'), 'seo_description' => self::text('Deskripsi SEO', 'textarea')])]);
        }
        $fields = ['title' => $title, 'summary' => self::text('Ringkasan', 'textarea'), 'lengthOfStay' => self::text('Lama tinggal / status usaha'), 'processingTime' => self::text('Waktu proses'), 'visaValidity' => self::text('Masa berlaku'), 'documentIntro' => self::text('Pengantar persyaratan', 'textarea')];
        foreach (['whatsAllowed' => 'Aktivitas yang diizinkan', 'whatsNotAllowed' => 'Pembatasan', 'documentRequirements' => 'Persyaratan dokumen', 'included' => 'Cakupan layanan', 'additionalInformation' => 'Informasi tambahan'] as $key => $label) {
            $fields[$key] = self::list($label, self::text('Item', 'textarea'));
        }
        $pair = fn ($label) => self::object($label, [0 => self::text('English (EN)'), 1 => self::text('Bahasa Indonesia (ID)')]);
        $prices = ['idr' => self::text('Harga IDR', 'number'), 'usd' => self::text('Tambahan USD', 'number'), 'marker' => self::text('Penanda harga'), 'basis' => $pair('Keterangan harga')];
        $prices['options'] = self::list('Opsi harga', self::object('Opsi', ['idr' => self::text('Harga IDR', 'number'), 'usd' => self::text('Tambahan USD', 'number'), 'label' => $pair('Label durasi'), 'note' => $pair('Catatan')]));

        return self::object('', ['translations' => self::locales($fields), 'details' => self::object('Identitas dan gambar', ['code' => self::text('Kode layanan'), 'thumbnail' => self::text('Gambar layanan', 'image'), 'group' => self::text('Grup legal', 'legal-group'), 'legalIcon' => self::text('Ikon legal', 'icon')]), 'pricing' => self::object('Harga dan opsi', $prices)]);
    }

    public static function rules(array $schema, string $path = ''): array
    {
        if ($schema['type'] === 'object') {
            $rules = $path ? [$path => 'nullable|array'] : [];
            foreach ($schema['fields'] as $key => $field) {
                $rules += self::rules($field, ltrim($path.'.'.$key, '.'));
            }

            return $rules;
        }
        if ($schema['type'] === 'list') {
            return [$path => 'nullable|array|max:60'] + self::rules($schema['item'], $path.'.*');
        }
        $rule = ($schema['required'] ?? false) ? 'required' : 'nullable';
        if ($schema['type'] === 'image') {
            return [$path => [$rule, 'string', 'max:255', 'regex:~^(?:cms/[A-Za-z0-9/_-]+\.(?:jpg|jpeg|png|webp)|[A-Za-z0-9_-]+\.(?:jpg|jpeg|png|webp))$~i']];
        }
        $rule .= match ($schema['type']) {
            'number' => '|numeric|min:0|max:999999999999', 'legal-group' => '|in:formation,corporate', 'icon' => '|in:'.implode(',', array_keys(self::icons())), default => '|string|max:'.($schema['type'] === 'markdown' ? '100000' : '10000')
        };

        return [$path => $rule];
    }

    public static function clean(array $schema, mixed $value): mixed
    {
        if ($schema['type'] === 'object') {
            $result = [];
            foreach ($schema['fields'] as $key => $child) {
                $result[$key] = self::clean($child, is_array($value) ? ($value[$key] ?? null) : null);
            }

            return $result;
        }
        if ($schema['type'] === 'list') {
            return array_values(array_map(fn ($item) => self::clean($schema['item'], $item), is_array($value) ? $value : []));
        }
        if ($schema['type'] === 'number') {
            return $value === null || $value === '' ? null : (float) $value;
        }

        return $value ?? '';
    }

    public static function imagePaths(array $schema, string $path = ''): array
    {
        if ($schema['type'] === 'image') {
            return [$path => true];
        }
        if ($schema['type'] === 'list') {
            return self::imagePaths($schema['item'], $path.'.*');
        }
        $paths = [];
        foreach ($schema['fields'] ?? [] as $key => $child) {
            $paths += self::imagePaths($child, ltrim($path.'.'.$key, '.'));
        }

        return $paths;
    }
}

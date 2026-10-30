<?php

namespace App\Support;

class SiteLanguage
{
    public const LOCALES = ['en', 'id', 'ru', 'es'];

    public static function text(string $en, string $id, string $locale): string
    {
        if (in_array($locale, ['en', 'id'], true)) {
            return app(CmsContent::class)->copy($en, $id, $locale);
        }

        $translations = config('translations.'.$locale, []);
        if (str_starts_with($en, 'Learn more about ')) {
            $service = substr($en, strlen('Learn more about '));

            return ($translations['Learn more about '] ?? 'Learn more about ').($translations[$service] ?? $service);
        }

        return $translations[$en] ?? $en;
    }
}

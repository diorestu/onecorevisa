<?php

namespace App\Support;

use Illuminate\Support\Str;

class ArticleBody
{
    public static function render(?string $body): string
    {
        return Str::markdown($body ?? '', ['html_input' => 'strip', 'allow_unsafe_links' => false, 'max_nesting_level' => 20]);
    }
}

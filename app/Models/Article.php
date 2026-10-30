<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return ['translations' => 'array', 'published_at' => 'datetime'];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'published')->whereNotNull('published_at')->where('published_at', '<=', now())
            ->where(fn ($q) => $q->whereNull('category_id')->orWhereHas('category', fn ($c) => $c->where('is_active', true)));
    }

    public function title(string $locale = 'en'): string
    {
        return $this->translations[$locale]['title'] ?? $this->translations['en']['title'] ?? $this->slug;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return ['translations' => 'array', 'details' => 'array', 'is_active' => 'boolean'];
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function title(string $locale = 'en'): string
    {
        return $this->translations[$locale]['title'] ?? $this->translations['en']['title'] ?? $this->slug;
    }
}

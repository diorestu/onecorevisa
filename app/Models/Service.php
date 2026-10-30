<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected function casts(): array
    {
        return ['translations' => 'array', 'details' => 'array', 'pricing' => 'array'];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function title(string $locale = 'en'): string
    {
        return $this->translations[$locale]['title'] ?? $this->translations['en']['title'] ?? $this->slug;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CopyText extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return ['translations' => 'array'];
    }
}

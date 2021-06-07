<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editor extends Model
{
    use HasFactory;

    public function scopeKey($query, $key)
    {
        return $query->where('key', $key)->first()->value;
    }
}

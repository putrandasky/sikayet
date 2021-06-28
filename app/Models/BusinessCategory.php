<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function companies()
    {
        return $this->hasMany(Company::class);
    }
    public function scopeId($query, $value)
    {
        return $query->where('id', $value);
    }
}

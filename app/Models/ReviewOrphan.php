<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewOrphan extends Model
{
    use HasFactory;
    public function scopeId($query, $value)
    {
        return $query->where('id', $value);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function review_type()
    {
        return $this->belongsTo(ReviewType::class);
    }
    public function review_status()
    {
        return $this->belongsTo(ReviewStatus::class);
    }
    public function scopeWithBelongings($query)
    {
        return $query->with([
            'user' => function ($query) {
                $query->select(['id', 'name']);
            }, 'review_status', 'review_type',
        ]);
    }
}

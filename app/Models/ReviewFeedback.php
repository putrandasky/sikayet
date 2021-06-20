<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewFeedback extends Model
{
    use HasFactory;
    public function scopeFindBy($query, $value)
    {
        return $query->where([
            'user_id' => $value[0],
            'review_id' => $value[1],
        ]);
    }
}

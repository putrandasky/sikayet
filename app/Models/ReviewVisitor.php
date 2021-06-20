<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewVisitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip_address',
        'review_id',
        'last_visit',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'icon',
        'subsciption_type',
        'subsciption_subtitle',
        'respond_quota',
        'monthly_price',
        'annual_price',
    ];
}

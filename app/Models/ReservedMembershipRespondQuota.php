<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservedMembershipRespondQuota extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_release_date',
        'is_released',
        'respond_quota',
        'membership_history_id',
        'company_id',
    ];
}

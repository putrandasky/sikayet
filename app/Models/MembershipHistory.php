<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipHistory extends Model
{
    use HasFactory;
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function scopeCompanyId($query, $value)
    {
        return $query->where('company_id', $value);
    }
    public function scopeId($query, $value)
    {
        return $query->where('id', $value);
    }
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'PAID');
    }
    public function scopeUnpaid($query)
    {
        return $query->where('payment_status', '!=', 'PAID');
    }

}

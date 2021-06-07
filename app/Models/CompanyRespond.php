<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyRespond extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the CompanyRespond
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function scopeCompanyId($query, $value)
    {
        return $query->where('company_id', $value);
    }
}

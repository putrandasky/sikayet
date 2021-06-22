<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    /**
     * Get the user that owns the Review
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the company that owns the Review
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function company_respond()
    {
        return $this->hasOne(CompanyRespond::class);
    }
    public function review_type()
    {
        return $this->belongsTo(ReviewType::class);
    }
    public function review_status()
    {
        return $this->belongsTo(ReviewStatus::class);
    }
    public function scopeId($query, $value)
    {
        return $query->where('id', $value);
    }
    public function scopeSlug($query, $value)
    {
        return $query->where('slug', $value);
    }
    public function scopeUserId($query, $value)
    {
        return $query->where('user_id', $value);
    }
    public function scopeCompanyId($query, $value)
    {
        return $query->where('company_id', $value);
    }
    public function scopeLatestUpdate($query)
    {
        return $query->orderBy('updated_at', 'DESC');
    }
    public function scopeHasStatus($query, $value)
    {
        return $query->where('review_status_id', $value);
    }
    public function scopeWithBelongings($query)
    {
        return $query->with([
            'user' => function ($query) {
                $query->select(['id', 'name']);
            },
            'company' => function ($query) {
                $query->select(['id', 'name']);
            },
            'review_status', 'review_type',
        ]);
    }
}

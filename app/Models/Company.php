<?php

namespace App\Models;

use App\Notifications\CompanyResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $fillable = [
        'name',
        'email',
        'password',
        'slug',
        'account_status_id',
        'business_category_id',
        'is_verified',
        'membership_id',
    ];
    protected $guard = 'company';
    /**
     * Get the user that owns the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function business_category()
    {
        return $this->belongsTo(BusinessCategory::class);
    }
    public function account_status()
    {
        return $this->belongsTo(AccountStatus::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function membership_active()
    {
        return $this->hasOne(MembershipActive::class);
    }
    public function scopeId($query, $value)
    {
        return $query->where('id', $value);
    }
    public function scopeSlug($query, $value)
    {
        return $query->where('slug', $value);
    }
    public function scopeHasMembershipActive($query, $value)
    {
        if ($value) {
            return $query->has('membership_active')->with('membership_active');
        } else {
            return $query->doesnthave('membership_active');
        }
    }
    public function scopeIsVerified($query, $value)
    {
        return $query->where('is_verified', $value);
    }
    public function scopeHasStatus($query, $value)
    {
        return $query->where('account_status_id', $value)->with('account_status');
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CompanyResetPasswordNotification($token));
    }
}

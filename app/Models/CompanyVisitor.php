<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyVisitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip_address',
        'company_id',
        'last_visit',
    ];
}

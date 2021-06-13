<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditorFaqGroup extends Model
{
    use HasFactory;
    public function editor_faqs()
    {
        return $this->hasMany(EditorFaq::class);
    }
}

<?php

namespace App\Models;

use App\Models\Variant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Price extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
}

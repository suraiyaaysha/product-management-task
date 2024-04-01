<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Variant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function productUnits()
    {
        return $this->belongsToMany(Unit::class, 'product_units')->withPivot('value');
    }
}

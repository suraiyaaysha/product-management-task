<?php

namespace App\Models;

use App\Models\Price;
use App\Models\Product;
use App\Models\VariantValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Variant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function values()
    {
        return $this->hasMany(VariantValue::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

}

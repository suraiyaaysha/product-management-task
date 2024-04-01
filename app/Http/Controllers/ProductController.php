<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products',
            'tax' => 'nullable|numeric',
            'unit' => 'required',
            'unit_value' => 'required',
            'variant_name.*' => 'required',
            'variant_price.*' => 'required|numeric',
            'variant_values.*.*' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $file = $request->image;
        $url = $file->move('uploads/product-img', $file->hashName());

        // Create the product
        $product = Product::create([
            'name' => $request->name,
            'sku' => $request->sku,
            'selling_price' => $request->selling_price,
            'purchase_price' => $request->purchase_price,
            'discount' => $request->discount,
            'tax' => $request->tax,
            'unit' => $request->unit,
            'unit_value' => $request->unit_value,
            'image' => $url,
        ]);

        // Attach Unit
        $unit = Unit::firstOrCreate(['name' => $request->unit]);
        $product->productUnits()->attach($unit->id, ['value' => $request->unit_value]);

        // Handle variants and variant prices
        $variants = $request->input('variant_name');
        $variantPrices = $request->input('variant_price');
        $variantValues = $request->input('variant_values');

        if ($variants && $variantPrices && $variantValues) {
            foreach ($variants as $key => $variant) {
                $newVariant = $product->variants()->create([
                    'name' => $variant,
                ]);

                // Store variant price
                $newVariant->prices()->create([
                    'price' => $variantPrices[$key],
                ]);

                // Store variant values if provided
                foreach ($variantValues[$key] as $value) {
                    $newVariant->values()->create([
                        'value' => $value,
                    ]);
                }
            }
        }

        return redirect()->route('products.create')->with('success', 'Product created successfully');
    }
}

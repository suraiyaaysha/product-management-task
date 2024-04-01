<?php

namespace Database\Factories;

use App\Models\Unit;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'sku' => $this->faker->unique()->uuid,
            'selling_price' => $this->faker->randomFloat(2, 10, 100),
            'purchase_price' => $this->faker->randomFloat(2, 5, 50),
            'discount' => $this->faker->numberBetween(0, 50),
            'tax' => $this->faker->numberBetween(0, 20),
            'unit' => $this->faker->randomElement(['Piece', 'Kg', 'Liter']),
            'unit_value' => $this->faker->randomNumber(2),
            'image' => 'https://via.placeholder.com/300',
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $unit = Unit::firstOrCreate(['name' => $product->unit]);
            $product->productUnits()->attach($unit->id, ['value' => $product->unit_value]);
        });
    }

    protected function getSampleImages()
    {
        return Storage::files('public/sample_images');
    }
}

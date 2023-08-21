<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition(): array
    {
        $category_name = $this->faker->unique()->words($nb = 2, $asText = true);
        $slug = Str::slug($category_name,'-');
        return [
            'name' => $category_name,
            'slug' => $slug,
            'short_description' => $this->faker->text(200),
            'description' => $this->faker->text(500),
            'regular_price' => $this->faker->numberBetween(10,500),
            'seo' => 'PSR'. $this->faker->numberBetween(100,500),
            'stock_status' => 'instock',
            'quantity' => $this->faker->numberBetween(10,50),
            'image' => 'product-'.$this->faker->numberBetween(1,16),
            'category_id' => $this->faker->numberBetween(1,5)

        ];
    }
}

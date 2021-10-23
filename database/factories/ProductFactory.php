<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = ['Bag', 'Shoes', 'Shirt', 'Pants', 'watch'];

        return [
            'name' => $this->faker->word(),
            'category' => $categories[array_rand($categories)],
            'description' => $this->faker->paragraph($nb = 2),
            'date_time' => now(),
        ];
    }
}

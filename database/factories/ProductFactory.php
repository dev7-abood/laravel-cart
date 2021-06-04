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
        return [
            'name' => $this->faker->name,
            'image' => '/assets/images/product-'.$this->faker->randomElement([2,3,4,5,6,7,8,9]).'.jpg',
            'price' => $this->faker->randomElement([2.5,2.5,4.9,4.6])
        ];
    }
}

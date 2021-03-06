<?php

namespace Database\Factories;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Discount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'active_from' => $this->faker->dateTime(),
            'name' => $this->faker->sentence(),
            'discount_value' => $this->faker->randomFloat(1, $min = 5, $max = 40),
        ];
    }
}

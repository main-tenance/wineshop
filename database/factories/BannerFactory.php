<?php

namespace Database\Factories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Banner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->word,
            'title' => $this->faker->sentence(7),
            'big_title' => $this->faker->sentence(5),
            'small_title' => $this->faker->sentence(10),
            'notice' => $this->faker->sentence(20),
            'href' => $this->faker->url(),
        ];
    }
}


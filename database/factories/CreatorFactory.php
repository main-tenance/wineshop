<?php

namespace Database\Factories;

use App\Models\Code;
use App\Models\Creator;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreatorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Creator::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'code' => $this->faker->unique()->word,
//            'code' => $this->faker->unique()->lexify('???'),
            'original' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(7),
            ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Code;
use App\Models\Vine;
use Illuminate\Database\Eloquent\Factories\Factory;

class VineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'code' => Code::factory()->create()->code,
            'description' => $this->faker->paragraph(7),
            ];
    }
}

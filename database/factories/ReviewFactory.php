<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userId = User::all()->shuffle()->pluck('id')->first();
        return [
            'user_id' => $userId,
            'rating' => $this->faker->numberBetween(2, 5),
            'comment' => $this->faker->paragraph(7),
        ];
    }
}

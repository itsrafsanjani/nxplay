<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\Video;
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
        return [
            'user_id' => User::all()->random()->id,
            'video_id' => Video::all()->random()->id,
            'title' => $this->faker->realText(20),
            'body' => $this->faker->realText(120),
            'rating' => random_int(1,9).'.'.random_int(1,9),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Video;
use App\Models\VideoLike;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoLikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VideoLike::class;

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
            'status' => random_int(0,1),
        ];
    }
}

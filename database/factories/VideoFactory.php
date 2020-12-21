<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => random_int(1,10),
            'title' => $this->faker->unique()->realText(20),
            'description' => $this->faker->realText(100),
            'type' => random_int(0,1),
            'views' => random_int(1000,100000),
            'runtime' => $this->faker->numberBetween(40, 180),
            'year' => $this->faker->numberBetween(1990, 2020),
            'imdb_id' => 'tt'.$this->faker->unique()->randomNumber(7),
            'imdb_rating' => random_int(1,9),
            'genres' => json_encode(['thriller', 'horror', 'drama']),
            'country' => $this->faker->countryCode,
            'poster' => $this->faker->imageUrl(),
            'video' => 'http://nxplay.test/storage/videos/video.mp4',
            'status' => 1,
        ];
    }
}

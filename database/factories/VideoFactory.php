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
            'type' => 'Movie',
            'views' => random_int(1000,100000),
            'runtime' => $this->faker->numberBetween(40, 180).' min',
            'year' => $this->faker->numberBetween(1990, 2020),
            'imdb_id' => 'tt'.$this->faker->unique()->randomNumber(7),
            'imdb_rating' => rand(1,9),
            'genres' => json_encode(['thriller', 'horror', 'drama']),
            'country' => json_encode(['Bangladesh', 'India', 'Pakistan']),
            'directors' => json_encode(['Christopher Nolan', 'James Cameron']),
            'actors' => json_encode(['Leonardo DiCaprio', '	Tom Hardy', 'Cillian Murphy']),
            'box_office' => '$'.random_int(20000, 1000000000),
            'poster' => 'http://via.placeholder.com/270x400.png?text=NXPlay',
            'video' => 'video.mp4',
            'status' => 1,
        ];
    }
}

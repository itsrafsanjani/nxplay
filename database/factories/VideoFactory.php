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
            'type' => 'movie',
            'views' => random_int(1000,100000),
            'runtime' => $this->faker->numberBetween(40, 180).' min',
            'year' => $this->faker->numberBetween(1990, 2020),
            'imdb_id' => 'tt'.$this->faker->unique()->randomNumber(7),
            'imdb_rating' => rand(4,1),
            'genres' => json_encode(['thriller', 'horror', 'drama']),
            'country' => json_encode(['Bangladesh', 'India', 'Pakistan']),
            'directors' => json_encode(['Christopher Nolan', 'James Cameron']),
            'actors' => json_encode(['Leonardo DiCaprio', '	Tom Hardy', 'Cillian Murphy']),
            'box_office' => '$'.random_int(20000, 1000000000),
            'poster' => '9gk7adHYeDvHkCSEqAvQNLV5Uge.jpg',
            'video' => 'video.mp4',
            'photos' => json_encode(['MV5BMjIyNjk1OTgzNV5BMl5BanBnXkFtZTcwOTU0OTk1Mw@@._V1_Ratio1.5000_AL_.jpg', 'MV5BNjMxNjI1Mjc1OV5BMl5BanBnXkFtZTcwMDY0OTk1Mw@@._V1_Ratio1.5000_AL_.jpg', 'MV5BMTk1NDM4MDMwMF5BMl5BanBnXkFtZTcwMjY0OTk1Mw@@._V1_Ratio1.5000_AL_.jpg', 'MV5BMTY3MzMzMDgyMF5BMl5BanBnXkFtZTcwMzY0OTk1Mw@@._V1_Ratio1.5000_AL_.jpg', 'MV5BMTMxNDExNzM4MV5BMl5BanBnXkFtZTcwNDY0OTk1Mw@@._V1_Ratio1.5000_AL_.jpg', 'MV5BMjExMjkwNTQ0Nl5BMl5BanBnXkFtZTcwNTY0OTk1Mw@@._V1_Ratio1.0000_AL_.jpg', 'MV5BMTM0MjUzNjkwMl5BMl5BanBnXkFtZTcwNjY0OTk1Mw@@._V1_Ratio1.0000_AL_.jpg', 'MV5BMTgxNjg2OTc2M15BMl5BanBnXkFtZTcwNzY0OTk1Mw@@._V1_Ratio2.4200_AL_.jpg', 'MV5BMTAyNjQ2NTIyMzBeQTJeQWpwZ15BbWU3MDY3NDk5NTM@._V1_Ratio2.3800_AL_.jpg']),
            'age_rating' => 'PG-13',
            'likes' => random_int(20000, 20000000),
            'dislikes' => random_int(1, 500000),
            'status' => 1,
        ];
    }
}

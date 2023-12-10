<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        $comment = Comment::factory()
//            ->count(3)
//            ->for(User::factory()->count(10))
//            ->for(VideoRule::factory()->count(10))
//            ->create();
        return [
            'user_id' => User::all()->random()->id,
            'video_id' => Video::all()->random()->id,
            'comment_text' => $this->faker->realText(120),
//            'parent_id' => Comment::all()->random()->id,
            'parent_id' => null,
            'replied_to_id' => User::all()->random()->id
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\Review;
use App\Models\User;
use App\Models\Video;
use App\Models\VideoLike;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Md Rafsan Jani Rafin',
            'email' => 'mdrafsanjanirafin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
            'avatar' => 'https://www.gravatar.com/avatar/' . md5('mdrafsanjanirafin@gmail.com'),
            'role' => 1
        ]);
        User::create([
            'name' => 'Ratul Hasan',
            'email' => 'ratulxman@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
            'avatar' => 'https://www.gravatar.com/avatar/' . md5('imamagun94@gmail.com'),
            'role' => 1
        ]);

        // User::factory(10)->create();
        // VideoRule::factory(10)->create();
        $this->call(GeneratedVideosTableSeeder::class);
        Review::factory(10)->create();
        Comment::factory(10)->create();
        VideoLike::factory(10)->create();
        CommentLike::factory(10)->create();
    }
}

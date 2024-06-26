<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::factory(10)
            ->create();
    }
}

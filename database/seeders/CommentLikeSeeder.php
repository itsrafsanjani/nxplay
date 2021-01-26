<?php

namespace Database\Seeders;

use App\Models\CommentLike;
use Illuminate\Database\Seeder;

class CommentLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommentLike::factory(10)->create();
    }
}

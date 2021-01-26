<?php

namespace Database\Seeders;

use App\Models\VideoLike;
use Illuminate\Database\Seeder;

class VideoLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VideoLike::factory(10)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        VideoRule::factory(50)->create();
        Video::factory()
            ->count(3)
            ->for(User::factory())
            ->create();
    }
}

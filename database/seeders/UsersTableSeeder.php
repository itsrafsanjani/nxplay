<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        User::factory(10)->create();

        User::factory(10)
            ->has(Video::factory()->count(10))
            ->create();
    }
}

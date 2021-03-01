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
            'password' => bcrypt(11111111), // password
            'remember_token' => Str::random(10),
            'avatar' => 'https://www.gravatar.com/avatar/' . md5(strtolower(trim('mdrafsanjanirafin@gmail.com'))),
            'role' => 1,
            'fcm_token' => 'esEgleQ7QVY:APA91bG7qvLnzw8w6h-gVImHHbY0pT6Uj2AZynv99Se2irw34vOmWzqjWnzad84_dgxQ8SmpA1mguCc8vGWEEvWRFmjaNDvsYvVDrzk-U8q7G0I-WC9BzQsW1Bb46hPCqe2-tYbaJRd8',
            'last_login_at' => now()
        ]);
        User::create([
            'name' => 'Md Imam Hossain',
            'email' => 'imamagun94@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt(11111111), // password
            'remember_token' => Str::random(10),
            'avatar' => 'https://www.gravatar.com/avatar/' . md5(strtolower(trim('imamagun94@gmail.com'))),
            'role' => 1,
            'fcm_token' => 'drlc3FxFPEs:APA91bEDZivIXMoiFU3VkCxFWs3fg2-arnhQNmVWZko_OmkM7eD7uy4JxIohh4JNqusrZVw19copFmD5uTpF8rkTA2bMDTHKerzWPrG-am7bF-uHev-3EdgM4PGy51SqreVENKAQlA0U',
            'last_login_at' => now()
        ]);
        User::create([
            'name' => 'Radoanul Haider',
            'email' => 'radoan@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt(11111111), // password
            'remember_token' => Str::random(10),
            'avatar' => 'https://www.gravatar.com/avatar/' . md5(strtolower(trim('radoan@gmail.com'))),
            'role' => 1,
            'fcm_token' => 'd0NvW3WdmTY:APA91bEaODW3n_tvpGnjZlIUnrwxEsT-wk9a4u4dZVhItMxuPp0n5pl6iOLGlfR3u9V55rbGmmexINNc-QqrqGKu-pcIkxV1Z64tgzetwm_c-VgYAtu5pQDeIQevcOBzwFCubZ0AKYVl',
            'last_login_at' => now()
        ]);

//        User::factory(10)->create();
        Video::factory(10)->create();
        Review::factory(10)->create();
        Comment::factory(10)->create();
        VideoLike::factory(10)->create();
        CommentLike::factory(10)->create();
    }
}

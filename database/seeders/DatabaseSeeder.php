<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Video;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Country
        Country::insert([
            ['name' => 'Uzbekistan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kazakistan', 'created_at' => now(), 'updated_at' => now()]
        ]);

        //User
        User::factory()->create([
            'country_id' => Country::find(1)->id,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 12345678,
        ])->point()->create();

        $users = User::factory(10)->create();

        //Userpoint
        $users->map(fn($user) => $user->point()->create([
            'points' => rand(1, 50),
            'all_points' => rand(51, 500),
        ]));

        //Computer
        $users[0]->computer()->create(['model' => 'Hp 255G7']);
        $users[1]->computer()->create(['model' => 'Acer']);
        $users[2]->computer()->create(['model' => 'Victus']);

        //Phone
        $users[3]->phone()->create(['number' => '12-2321']);
        $users[4]->phone()->create(['number' => '41-4124']);
        $users[5]->phone()->create(['number' => '51-1515']);

        $posts = Post::factory(100)->create();

        //Tag
        Tag::insert([
            ['name' => 'Laravel', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Php', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Docker', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sanctum', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Telescope', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Laracast', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Linux', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Golang', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Composer', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Devops', 'created_at' => now(), 'updated_at' => now()],
        ]);

        $tags = Tag::all();
        //Pivot table tagpost
        $posts->each(function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(2)->pluck('id')->toArray()
            );
        });

        $country = Country::all();

        //Profile
        Profile::insert([
            ['country_id' => $country[0]['id'], 'user_id' => $users[0]['id'], 'address' => 'Uzbekistan', 'created_at' => now(), 'updated_at' => now()],
            ['country_id' => $country[1]['id'], 'user_id' => $users[1]['id'], 'address' => 'Uzbekistan', 'created_at' => now(), 'updated_at' => now()],
        ]);

        //Video
        Video::insert([
            ['title' => 'Cracking the System', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Cyber Heist', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Behind the Code', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Hacking the Matrix', 'created_at' => now(), 'updated_at' => now()],
        ]);

        $video = Video::all();

        //Comment
        $video[0]->comments()->create(
            [
                'content' => 'Ever wondered what happens behind the keyboard? Dive into the world of hackers.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $video[0]->comments()->create(
            [
                'content' => 'From cyber heists to hacktivism – the untold stories of digital warriors.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
        $video[1]->comments()->create(
            [
                'content' => 'The fine line between genius and cybercriminal.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $posts[0]->comments()->create(
            [
                'content' => 'Discover how hackers rewrite the rules of the digital age.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
        $posts[0]->comments()->create(
            [
                'content' => 'When ones and zeroes become the tools of revolution.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
        $posts[1]->comments()->create(
            [
                'content' => 'Peek into the shadowy corners of the internet where hackers thrive.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}

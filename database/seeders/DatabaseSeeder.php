<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
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

        $this->call(UserPermissionSeeder::class);

        $users = User::all();

        //Userpoint
        $users->map(fn($user) => $user->point()->create([
            'points' => rand(1, 50),
            'all_points' => rand(51, 500),
        ]));
        
        //Post
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

        //Comment
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

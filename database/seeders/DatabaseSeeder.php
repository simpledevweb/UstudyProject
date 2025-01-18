<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Country::insert([
            ['name' => 'Uzbekistan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kazakistan', 'created_at' => now(), 'updated_at' => now()]
        ]);

        User::factory()->create([
            'country_id' => Country::find(1)->id,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 12345678,
        ])->point()->create();

        $users = User::factory(10)->create();
        $users->map(fn($user) => $user->point()->create([
            'points' => rand(1,50),
            'all_points'=> rand(51,500),
        ]));

        $users[0]->computer()->create(['model' => 'Hp 255G7']);
        $users[1]->computer()->create(['model' => 'Acer']);
        $users[2]->computer()->create(['model' => 'Victus']);

        $users[3]->phone()->create(['number' => '12-2321']);
        $users[4]->phone()->create(['number' => '41-4124']);
        $users[5]->phone()->create(['number' => '51-1515']);
        
        $posts = Post::factory(100)->create();

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

        $posts->each(function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(2)->pluck('id')->toArray()
            );
        });

        $country = Country::all(); 

        Profile::insert([
            ['country_id' => $country[0]['id'], 'user_id' => $users[0]['id'], 'address' => 'Uzbekistan', 'created_at' => now(), 'updated_at' => now()],
            ['country_id' => $country[1]['id'], 'user_id' => $users[1]['id'], 'address' => 'Uzbekistan', 'created_at' => now(), 'updated_at' => now()],
        ]);

    }
}

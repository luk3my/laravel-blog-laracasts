<?php

namespace Database\Seeders;
use \App\Models\User;
use \App\Models\Category;
use \App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::truncate();
        Category::truncate();

        $user = User::factory()->create();

        Category::create([
            'name'=>'Personal',
            'slug'=>'personal'
        ]);

        Category::create([
            'name'=>'Family',
            'slug'=>'family'
        ]);

        $work = Category::create([
            'name'=>'Work',
            'slug'=>'work'
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $work->id,
            'title' => 'My work Post',
            'slug' => 'my-work-post',
            'excerpt' => 'exxxy',
            'body' => '<p>Lorem Ipsum..</p>'
        ]);

        
    }

}

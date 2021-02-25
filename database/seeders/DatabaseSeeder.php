<?php

namespace Database\Seeders;

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
         \App\Models\User::factory(20)->create();
        $categories = \App\Models\Category::factory(50)->create();
        \App\Models\Tag::factory(100)->create();
        \App\Models\Post::factory(40)->make(['category_id'=>null])->each(function($post) use ($categories){
            $post->category_id = $categories->random()->id;
            $post->save();

        });



    }
}

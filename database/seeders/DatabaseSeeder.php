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
    {    \App\Models\User::factory()->create(['id'=>0,'name'=>'No Name']);
        $users = \App\Models\User::factory(5)->create();
        \App\Models\Category::factory()->create(['id'=>0,'title'=>'uncategories','slug'=>'speshial']);
        $categories = \App\Models\Category::factory(5)->create();
        $tags=\App\Models\Tag::factory(10)->create();


       \App\Models\Post::factory(3000)->make(['category_id'=>null,'user_id'=>null])->each(function($post) use ($categories,$users,$tags){
            $post->category_id = $categories->random()->id;
            $post->user_id = $users->random()->id;
           $post->save();
            $post->tags()->attach($tags->random(rand(5,10))->pluck('id'));


        });



    }
   /* public function run()
    {
        $users = \App\Models\User::factory(50)->create();
        $categories = \App\Models\Category::factory(50)->create();
        $tags = \App\Models\Tag::factory(50)->create();
        $post = \App\Models\Post::factory(50)->make(['category_id' => null, 'user_id' => null])->each(function ($post) use ($users, $categories) {
            $post->category_id = $categories->random()->id;
            $post->user_id = $users->random()->id;
            $post->save();

        });

        $post->each(function ($post) use ($tags) {
            $post->tags()->attach($tags->random(rand(2, 10))->pluck('id'));
        });

    }*/
}

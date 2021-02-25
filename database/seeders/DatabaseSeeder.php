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
        $users = \App\Models\User::factory(20)->create();
        \App\Models\Category::factory()->create(['id'=>0,'title'=>'uncategories','slug'=>'speshial']);
        $categories = \App\Models\Category::factory(25)->create();
        $tags=\App\Models\Tag::factory(100)->create();


       \App\Models\Post::factory(1000)->make(['category_id'=>null,'user_id'=>null])->each(function($post) use ($categories,$users,$tags){
            $post->category_id = $categories->random()->id;
            $post->user_id = $users->random()->id;
           $post->save();
            $post->tags()->attach($tags->random(rand(5,10))->pluck('id'));


        });



    }
}

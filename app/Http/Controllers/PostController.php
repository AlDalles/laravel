<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class PostController extends Controller
{
    public function index(){
        $pages = \App\Models\Post::paginate(3);
        $link_main="";
        return view('pages/post/list',compact('pages','link_main'));
    }

    public function posts_tag($id){
        $link_main="/post/{$id}/list/tag";
        $pages = Tag::find($id)->posts()->paginate(3);

        return view('pages/post/list',compact('pages',"link_main"));
    }


    public function posts_category($id){
        $pages=Post::where("category_id",$id)->paginate(3);
        $link_main="/post/{$id}/list/cat";

        return view('pages/post/list',compact('pages',"link_main"));
    }

    public function create(){
        $post = new \App\Models\Post();
        $categories =  \App\Models\Category::all();
        $tags = \App\Models\Tag::all();
        $users = User::all();
        return view('pages/post/edit',compact('post','categories','tags','users'));
    }

    public function store(){

        $data = request()->all();
        $validator = validator()->make($data, [
            'title'=> ['required','min:5','unique:categories,title'],
            'slug'=> ['required','min:5','unique:categories,slug'],
            'body'=>['required','min:45'],
            'category_id'=>['required','exists:categories,id'],
            'tags_id'=>['required','exists:tags,id'],
            'user_id'=>['required','exists:users,id']


        ]);
        $error = $validator->errors();
        if(count($error)>0){
            $_SESSION['errors'] = $error->toArray();
            $_SESSION['data'] = $data;
            return new RedirectResponse($_SERVER['HTTP_REFERER']);
        }

        $post = new \App\Models\Post();
        $post->title=$data['title'];
        $post->body=$data['body'];
        $post->slug=$data['slug'];
        $post->category_id=$data['category_id'];
        $post->user_id=$data['user_id'];
        $post->save();
        $post->tags()->attach($data['tags_id']);
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "Post \"{$data['title']}\" successfully saved",

        ];
        return new RedirectResponse('/post/list');
    }
    public function update($id){


        $data = request()->all();
        $validator = validator()->make($data, [
            'title'=> ['required','min:5','unique:categories,title'],
            'slug'=> ['required','min:5','unique:categories,slug'],
            'body'=>['required','min:45'],
            'category_id'=>['required','exists:categories,id'],
            'tags_id'=>['required','exists:tags,id'],
            'user_id'=>['required','exists:users,id']

        ]);
        $error = $validator->errors();
        if(count($error)>0){
            $_SESSION['errors'] = $error->toArray();
            $_SESSION['data'] = $data;
            return new RedirectResponse($_SERVER['HTTP_REFERER']);
        }

        $post =  \App\Models\Post::find($id);
        $post->title=$data['title'];
        $post->slug=$data['slug'];
        $post->body=$data['body'];
        $post->category_id=$data['category_id'];
        $post->user_id=$data['user_id'];
        $post->save();
        $post->tags()->sync($data['tags_id']);
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "Post \"{$data['title']}\" successfully saved",

        ];
        return new RedirectResponse('/post/list');
    }

    public function edit($id){
        $post =  \App\Models\Post::find($id);
        $tags = \App\Models\Tag::all();
        $users = User::all();
        $categories = \App\Models\Category::all();
        return view('pages/post/edit',compact('post','categories','tags','users'));

    }

    public function destroy($id){

        $post =  \App\Models\Post::find($id);
        $title=$post->title;
        $post->delete();
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "Post \"{$title}\" successfully deleted",

        ];

        return new RedirectResponse('/post/list');

    }
}

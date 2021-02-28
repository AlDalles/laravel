<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class PostController extends Controller
{
    public function index(){
        $pages = \App\Models\Post::paginate(3);

        return view('pages/post/list',compact('pages'));


    }

    public function posts_tag($id){
        //$link_main="/post/{$id}/list/tag";
        $pages = Tag::find($id)->posts()->paginate(3);

        return view('pages/post/list',compact('pages'));
    }


    public function posts_category($id){
        $pages=\App\Models\Post::where("category_id",$id)->paginate(3);


        return view('pages/post/list',compact('pages'));
    }

    public function post_user($id){
        $pages=\App\Models\Post::where("user_id",$id)->paginate(3);


        return view('pages/post/list',compact('pages',));
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
    public function postUserCategoryViewUsers()
    {
        $items= User::all();
        $method="post";
        $link="/user/category";
        $name="user_id";
        $nametitle="name";
        return view('pages/post/select-user',compact('items','link','name','nametitle','method'));


    }

    public function postUserCategoryViewCategories()
    {

        $link="/user/category/select";
        $method="post";
        $name="category_id";
        $nametitle="title";
        $id=$_POST['user_id'];
        $items=Category::find(Post::where('user_id',$id)->get()->pluck('category_id'));

        if($items->count()>0){
         return view('pages/post/select-category',compact('items','link','name','nametitle','id','method'));}
        else return new RedirectResponse($_SERVER['HTTP_REFERER']);


    }
    public function postUserCategoryRedirectString()
    {
        $data = request()->all();
        return new RedirectResponse("/user/".$data['id']."/category/".$data['category_id']);

    }

    public function postUserCategoryView(User $user,Category $category){

        $pages = User::find($user->id)->posts()->where('category_id',$category->id)->paginate(3);
        return view('pages/post/list',compact('pages'));
    }



    public function postCategoryUserViewCategory()
    {
        $items = Category::all();
        //dd($items);
        $method="post";
        $link="/category/user";
        $name="category_id";
        $nametitle="title";
        return view('pages/post/select-category',compact('items','link','name','nametitle','method'));


    }

    public function postCategoryUserViewUsers()
    {
        $link="/category/user/index";
        $method="post";
        $name="user_id";
        $nametitle="name";
        $id=$_POST['category_id'];
        $category_id=$_POST['id'];
        $items=User::find(Post::where('user_id',$id)->get()->pluck('category_id'));
        if($items->count()>0) {
            return view('pages/post/select-user', compact('items', 'link', 'name', 'nametitle', 'id', 'method'));
        }
        else return new RedirectResponse($_SERVER['HTTP_REFERER']);
    }

    public function postCategoryUserRedirectString()
    {
        $data = request()->all();
        return new RedirectResponse("/user/".$data['user_id']."/category/".$data['id']);

    }

    public function postCategoryUserView(User $user,Category $category){

        $pages = User::find($user->id)->posts()->where('category_id',$category->id)->paginate(3);
        return view('pages/post/list',compact('pages'));
    }

    public function search(){
        $users=User::all();
        $categories=Category::all();
        $tags=Tag::all();
        return view('pages/post/search',compact('categories','tags','users'));


    }
public function redirectString()
{
    $data = request()->all();
    $validator = validator()->make($data, [
        'category_id'=>['required','exists:categories,id'],
        'tag_id'=>['required'],
        'user_id'=>['required','exists:users,id']


    ]);
    $error = $validator->errors();
    if(count($error)>0){
        $_SESSION['errors'] = $error->toArray();
        $_SESSION['data'] = $data;
        return new RedirectResponse($_SERVER['HTTP_REFERER']);

    }
    return new RedirectResponse("/user/".$data['user_id']."/category/".$data['category_id']."/tag/".$data['tag_id']);



}

    public function searchResult(User $user,Category $category,Tag $tag){

        $pages=Post::where('category_id',$category->id)->where('user_id',$user->id)->whereHas('tags',function (\Illuminate\Database\Eloquent\Builder $query) use ($tag){
            $query->where('tags.id',$tag->id);

        })->paginate(3);
      //  dd($pages);

        return view("pages/post/index",compact('pages'));

      /*  $data = request()->all();
        $validator = validator()->make($data, [
            'category_id'=>['required','exists:categories,id'],
            'tag_id'=>['required'],
            'user_id'=>['required','exists:users,id']


        ]);
        $error = $validator->errors();
        if(count($error)>0){
            $_SESSION['errors'] = $error->toArray();
            $_SESSION['data'] = $data;
            return new RedirectResponse($_SERVER['HTTP_REFERER']);

        }

        //$pages=Tag::find($tag_id)->posts()->where('user_id',$user_id)->where('category_id',$category_id)->paginate(3);
       //$pages=Tag::find($_POST['tag_id']??$_GET['tag_id'])->posts()->where('user_id',$_POST['user_id']??$_GET['user_id'])->where('category_id',$_POST['category_id']??$_GET['category_id'])->paginate(3);
        /*$posts = Post::where('user_id',$_POST['user_id']??$_GET['user_id'])->where('category_id',$_POST['category_id']??$_GET['category_id'])->whereHas('tags', function (Builder $query) {
            $query->whereIn('id', $_POST['tags_id']);
        })->get()->paginate(3);*/
        /*echo "/author/{author}/category/{category}/tag/{tag}";*/

        return view("pages/post/index",compact('pages'));


    }

}

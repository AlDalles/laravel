

@extends('layout1')

@section('title', 'tags')

@section('content')



    <h1 class = "info, info1">pages111</h1>
    @if(isset($_SESSION['message']))
        <div class="alert alert-{{$_SESSION['message']['status']}}" role="alert">
            {{$_SESSION['message']['message']}}
        </div>
        @unset($_SESSION['message'])
        @endif
    @foreach($pages as $post)

        <div class="text-white bg-dark info">
            <h1>{{ $post->title }}</h1><a href="/post/{{$post->id}}/edit"  type="submit" >Редактировать</a>
            <a href="/post/{{$post->id}}/delete"  type="submit" >Удалить</a>
        </div>
        <div class="text-info bg-dark info">
            <h3>category: <a href="/category/{{$post->category_id}}">{{$post->category->title}}</a></h3>
            <h3>Author: <a href="/author/{{$post->user_id}}">{{$post->user->name}}</a></h3>
        </div>
        <div class="text-primary info">
         <p>tags:
                @foreach($post->tags as $tag)
                    <a href="/tag/{{$tag->id}}">{{$tag->title}}</a>
                @endforeach
        </div>
        </br>
        <p class = "info">{{$post->body}}</p>
        </br>
    @endforeach
   <div class="page">
       {{ $pages->links() }}
   </div>


    @include('paginator')

@endsection

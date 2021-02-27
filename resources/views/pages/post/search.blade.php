@extends('layout1')

@section('title', 'Categories')

@section('content')



    <h1> Search </h1>

    <form action="/searchIndex" method="get">
        @csrf
        выберите автора<select name ="user_id" size="5">



            @forelse($users as $user)
                <option  value={{ $user->id }}>{{ $user->name }}</option>

            @empty
                <p>no users</p>
            @endforelse
        </select>
        @if (isset($_SESSION['errors']['user_id']))
            @foreach($_SESSION['errors']['user_id'] as $error)

                <div class="alert alert-warning" role="alert">
                    {{$error}}
                </div>
            @endforeach

        @endif
        выберите категорию <select name="category_id" size="5">

            @forelse($categories as $category)
                <option  value={{ $category->id }}>{{ $category->title }}</option>

            @empty
                <p>no categories</p>
            @endforelse
        </select>
        @if (isset($_SESSION['errors']['category_id']))
            @foreach($_SESSION['errors']['category_id'] as $error)

                <div class="alert alert-warning" role="alert">
                    {{$error}}
                </div>
            @endforeach

        @endif

        {{--<div class="chackbox">
            @foreach($tags as $tag)
                <div class="input-group">
                    @if(isset($_SESSION['data']['tags_id']))
                        <input @if(array_search($tag->id,$_SESSION['data']['tags_id'])!==false) checked @endif class = "input-checkbox" type="checkbox" name="tags_id[]" value={{$tag->id}}>{{$tag->title}}
                    @else
                        <input  class = "input-checkbox" type="checkbox" name="tags_id[]" value={{$tag->id}}>{{$tag->title}}
                    @endif

                </div>
            @endforeach
        </div>--}}

        <select name="tag_id" size="5">

            @forelse($tags as $tag)
                <option  value={{ $tag->id }}>{{ $tag->title }}</option>

            @empty
                <p>no tags</p>
            @endforelse
        </select>

        @if (isset($_SESSION['errors']['tags_id']))
            @foreach($_SESSION['errors']['tags_id'] as $error)

                <div class="alert alert-warning" role="alert">
                    {{$error}}
                </div>
            @endforeach

        @endif



        <div class="submit">
            <input class = "input-checkbox submit-save" type="submit" name="find" value="Find">
        </div>
    </form>

    @php unset($_SESSION['errors']);
     unset($_SESSION['data']);

    @endphp

@endsection

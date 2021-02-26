@extends('layout1')

@section('title', 'Categories')

@section('content')



    <h1> Search </h1>

    <form action="" method="post">
        @csrf
        выберите автора<select name ="user_id" size="5">



            @forelse($users as $user)
                <option  value={{ $user->id }}>{{ $user->name }}</option>

            @empty
                <p>no users</p>
            @endforelse
        </select>
        выберите категорию <select name="category_id" size="5">

            @forelse($categories as $category)
                <option  value={{ $category->id }}>{{ $category->title }}</option>

            @empty
                <p>no categories</p>
            @endforelse
        </select>

        <div>
            @foreach($tags as $tag)
                <div class="input-group">


                        <input class = "input-checkbox" type="checkbox" name="tags_id[]" checked value={{$tag->id}}>{{$tag->title}}


                </div>
            @endforeach
        </div>



        <input name ="update" type="submit" value="search"><br>
    </form>



@endsection

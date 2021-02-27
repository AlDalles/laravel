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

        <div>
            выберите теги <select name="tag_id" size="5">
            @foreach($tags as $tag)
                <option  value={{ $tag->id }}>{{ $tag->title }}</option>
            @endforeach
                @if (isset($_SESSION['errors']['tag_id']))
                    @foreach($_SESSION['errors']['tag_id'] as $error)

                        <div class="alert alert-warning" role="alert">
                            {{$error}}
                        </div>
            @endforeach

            @endif
        </div>



        <input name ="update" type="submit" value="search"><br>
    </form>

    @php unset($_SESSION['errors']);
     unset($_SESSION['data']);

    @endphp

@endsection

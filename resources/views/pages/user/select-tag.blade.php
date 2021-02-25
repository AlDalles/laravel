@extends('layout1')

@section('title', 'users')

@section('content')

    <h1>users Update </h1>

<form action="/user/update" method="post">
    @csrf
        <select name = id size="1">


    @forelse($users as $user)
                <option  value={{ $user->id }}>{{ $user->name }}</option>

@empty
            <p>no users</p>
@endforelse
        </select>
    <input type="hidden" name="mark" value="mark">
    <input name ="update" type="submit" value="select user"><br>

    </form>



@endsection

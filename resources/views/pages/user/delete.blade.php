@extends('layout1')

@section('title', 'delete-users')

@section('content')
    <h1> Список Пользователей</h1>
    <form method="get" action='delete_many'>
        @csrf
        <select name = "users_id[]" size={{$users->count()}} multiple="multiple">
            @forelse($users as $user)


                <option value={{ $user->id }}>{{ $user->name }}</option>

            @empty
                <p>no users</p>
            @endforelse



        </select> <br><input name ="submit" type="submit" value="delete users"></form>

@endsection

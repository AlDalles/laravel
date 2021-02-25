@extends('layout1')

@section('title', 'Users')

@section('content')


</br></br></br>
</br>
@if(isset($_SESSION['mark']))
    <form action="/user/{{$user->id}}/update" class="form-text" method="post">
        @else <form class="form-text" method="post">
            @endif

            @csrf
            <p>user name <input name="name" size="40" value="{{$_SESSION['data']['name']?? $user->name}}"><br>


            @if (isset($_SESSION['errors']['name']))
                @foreach($_SESSION['errors']['name'] as $error)

                    <div class="alert alert-warning" role="alert">
                        {{$error}}
                    </div>
                @endforeach

            @endif

            <p>user email <input name="email" size="40" value="{{$_SESSION['data']['email']?? $user->email}}"><br>
            @if(isset($_SESSION['errors']['email']))
                @foreach($_SESSION['errors']['email'] as $error)
                    <div class="alert alert-warning" role="alert">
                        {{$error}}
                    </div>
                @endforeach
            @endif
            <p>user password <input name="password" size="40" value="{{$_SESSION['data']['password']?? $user->password}}"><br>
            @if(isset($_SESSION['errors']['password']))
                @foreach($_SESSION['errors']['password'] as $error)
                    <div class="alert alert-warning" role="alert">
                        {{$error}}
                    </div>
                @endforeach
            @endif
            <p><input name ="submit" type="submit" value="save user">
        </form>
    @php unset($_SESSION['errors']);
     unset($_SESSION['data']);
     unset($_SESSION['mark']);
    @endphp
    @endsection

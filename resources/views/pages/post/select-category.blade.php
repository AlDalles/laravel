@extends('layout1')

@section('title', 'Categories')

@section('content')



    <h1> Update </h1>

<form action="{{$link}}" method="{{$method}}">
    @csrf
    <select name ={{$name}} size="1">



    @forelse($items as $item)
                <option  value={{ $item->id }}>{{ $item->$nametitle }}</option>

@empty
            <p>no categories</p>
@endforelse
        </select>
    <input type="hidden" name="id" value="@if(isset($id)) {{$id}} @endif">

    <input name ="update" type="submit" value="select"><br>
    </form>



@endsection

@extends('layouts/app')

@section('content')
    <div class=" container col-sm-4 col-sm-pull-4 ">
        <div><h4>{{ $user->name }}</h4></div>
        <div><img  src="{{$image}}" width="250"></div>
        <br>
        <div><a class="btn btn-outline-primary" href="{{$logout}}">logout</a></div>
    </div>

@endsection
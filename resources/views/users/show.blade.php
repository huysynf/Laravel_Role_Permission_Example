@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>User Name: {{$user->name}}</h1>
            <h1>Email: {{$user->email}}</h1>
        </div>
    </div>


@endsection

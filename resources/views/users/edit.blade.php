@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Edit:{{$user->name}}</h1>
            <form action="{{route('users.update', $user->id)}}" method="post">
                @csrf()
                @method('put')
                <div class="form-group">
                    <lable>Name</lable>
                    <input class="form-control" type="text" value="{{$user->name}}" name="name" >
                </div>

                <div class="form-group">
                    <lable>Email</lable>
                    <input type="email"  value="{{$user->email}}" class="form-control" name="email" >
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>
    </div>


@endsection

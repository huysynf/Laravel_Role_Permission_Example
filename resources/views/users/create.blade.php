@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{route('users.store')}}" method="post">
                @csrf()
                <div class="form-group">
                    <lable>Name</lable>
                    <input class="form-control" type="text" name="name" >
                </div>

                <div class="form-group">
                    <lable>Email</lable>
                    <input type="email" class="form-control" name="email" >
                </div>
                <div class="form-group">
                    <lable>Password</lable>
                    <input class="form-control" type="password" name="password" >
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>

            </form>
        </div>
    </div>

@endsection

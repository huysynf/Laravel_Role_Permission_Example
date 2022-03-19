@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{session('message')}}</strong>
            </div>
        @endif

        <a href="{{route('users.create')}}" class="btn btn-primary">Create</a>
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>

            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <a href="{{route('users.edit', $user->id)}}" class="btn btn-warning border-5">Edit</a>
                        <form action="{{route('users.destroy', $user->id)}}" method="post" id="DeleteForm-{{$user->id}}">@csrf() @method('delete')</form>
                        <button class="btn btn-danger border-5" type="submit" form="DeleteForm-{{$user->id}}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </table>

        <div>
            {{$users->links()}}
        </div>
    </div>


@endsection

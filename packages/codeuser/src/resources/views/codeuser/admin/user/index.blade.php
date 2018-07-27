@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Users</h3>

        <a href="{{ route('admin.users.create') }}">Create User</a>
        <br><br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Action</th>
            </tr>
            </thead>
            <tboby>
                @foreach($users as $key => $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <a name="link_edit_user_{{$key}}" href="{{route('admin.users.edit', ['id'=>$user->id])}}">
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tboby>
        </table>
    </div>

@endsection
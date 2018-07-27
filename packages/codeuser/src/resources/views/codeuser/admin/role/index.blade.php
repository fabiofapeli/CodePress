@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Roles</h3>

        <a href="{{ route('admin.roles.create') }}">Create Role</a>
        <br><br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tboby>
                @foreach($roles as $key => $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td>
                            <a name="link_edit_role_{{$key}}" href="{{route('admin.roles.edit', ['id'=>$role->id])}}">
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tboby>
        </table>
    </div>

@endsection
@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Create User</h3>

        {!! Form::open(['method'=>'user', 'route'=>['admin.users.store']]) !!}

        <div class="form-group">
            {!! Form::label('name', "Name:") !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', "E-mail:") !!}
            {!! Form::text('email', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', "Password:") !!}
            {!! Form::password('password', ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('roles[]', "Roles:") !!}
            {!! Form::select('roles[]', $roles, null,['class'=>'form-control', 'multiple' => 'multiple']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>

@endsection
@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Create Role</h3>

        {!! Form::open(['method'=>'post', 'route'=>['admin.roles.store']]) !!}

        <div class="form-group">
            {!! Form::label('Name', "Name") !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('permissions[]', "Permissions:") !!}
            {!! Form::select('permissions[]', $permissions, null,
                ['class'=>'form-control', 'multiple' => 'multiple']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>

@endsection
@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Edit Role</h3>

        {!! Form::model($role, ['method'=>'put', 'route'=>['admin.roles.update', $role->id]]) !!}

        <div class="form-group">
            {!! Form::label('Name', "name") !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('permissions[]', "Permissions:") !!}
            {!! Form::select('permissions[]', $permissions, $role->permissions->lists('id')->toArray(),
                ['class'=>'form-control', 'multiple' => 'multiple']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>

@endsection
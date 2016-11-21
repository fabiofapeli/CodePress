@extends('layouts.app')

@section('content')

   <div class="container">
       <h3>Create Category</h3>

      {!! Form::open(['method'=>'post', 'route' => 'admin.categories.store']) !!}

<?php
$selected = 0;
?>

       <div class="form-group">
        {!! Form::label('Parent', 'Parent:') !!}
        {!! Form::select('parent_id', $categories, $selected, ['class' => 'form-control']) !!}
       </div>


       <div class="form-group">
           {!! Form::label('name',"Name:") !!}
           {!! Form::text('name',null,['class'=>'form-control']) !!}
       </div>

       <div class="form-group">
           {!! Form::label('Active',"Active:") !!}
           {!! Form::checkbox('active',null,['class'=>'form-control']) !!}
       </div>

       <div class="form-group">
           {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
       </div>


       {!! Form::close() !!}

   </div>

@endsection
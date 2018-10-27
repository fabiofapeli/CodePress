@extends('layouts.app')

@section('content')

   <div class="container">
       <h3>Create Layout</h3>

      {!! Form::open(['method'=>'post', 'route' => 'admin.layouts.store', 'files' => true]) !!}
       
       @include('codeapp::layouts._form')

       <div class="form-group">
           {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
       </div>


       {!! Form::close() !!}

   </div>

@endsection
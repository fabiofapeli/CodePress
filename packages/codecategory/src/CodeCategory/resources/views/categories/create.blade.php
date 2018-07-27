@extends('layouts.app')

@section('content')

   <div class="container">
       <h3>Create Category</h3>

      {!! Form::open(['method'=>'post', 'route' => 'admin.categories.store']) !!}
       
       @include('codecategory::_form')

       <div class="form-group">
           {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
       </div>


       {!! Form::close() !!}

   </div>

@endsection
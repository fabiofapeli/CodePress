@extends('layouts.app')

@section('content')

   <div class="container">
       <h3>Edit Category</h3>

      {!! Form::model($category,['method'=>'put', 'route'=>array('admin.categories.update', "id=".$category->id)]) !!}
       
       @include('codecategory::_form')

       <div class="form-group">
           {!! Form::submit('Edit Category', ['class'=>'btn btn-primary']) !!}
       </div>


       {!! Form::close() !!}

   </div>

@endsection
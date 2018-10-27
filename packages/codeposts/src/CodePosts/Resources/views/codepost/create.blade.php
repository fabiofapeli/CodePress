@extends('layouts.app')

@section('content')

   <div class="container">
       <h3>Create Post</h3>

      {!! Form::open(['method'=>'post', 'route' => 'admin.posts.store']) !!}

       <div class="form-group">
           {!! Form::label('title',"Title:") !!}
           {!! Form::text('title',null,['class'=>'form-control']) !!}
       </div>

       <div class="form-group">
           {!! Form::label('categories',"Categories:") !!}
           {!! Form::select('categories[]', $categories, null,['class'=>'form-control', 'multiple' => 'true']) !!}
       </div>

       <div class="form-group">
           {!! Form::label('tags',"Tags:") !!}
           {!! Form::select('tags[]', $tags, null,['class'=>'form-control', 'multiple' => 'true']) !!}
       </div>

       <div class="form-group">
           {!! Form::label('content',"Content:") !!}
           {!! Form::textarea('content',null,['class'=>'form-control']) !!}
       </div>

       <div class="form-group">
           {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
       </div>


       {!! Form::close() !!}

   </div>

@endsection
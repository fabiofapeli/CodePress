@extends('layouts.app')

@section('content')

   <div class="container">
       <h3>Edit Post</h3>
      <?php
            $buttonText = $post->state == $post::STATE_PUBLISHED ? "Draft" : "Publish";
            $buttonClass = $post->state == $post::STATE_PUBLISHED ? "warning" : "success";
            $state = $post->state == $post::STATE_PUBLISHED ? $post::STATE_DRAFT : $post::STATE_PUBLISHED;
        ?>
       <h3>
         <span class="label label-{{ $post->state == $post::STATE_PUBLISHED ? "success" : "warning" }}">
         {{ $post->state == $post::STATE_PUBLISHED ? "Publish" : "Draft" }}
         </span>
       </h3>
       <p>Autor: <strong>{{ $post->user->name }}</strong></p>
      {!! Form::model($post, ['method'=>'put', 'route'=>['admin.posts.update', $post->id]]) !!}

       <div class="form-group">
           {!! Form::label('title',"Title:") !!}
           {!! Form::text('title',null,['class'=>'form-control']) !!}
       </div>
       
       <div class="form-group">
           {!! Form::label('categories',"Categories:") !!}
           {!! Form::select('categories_array', $categories, null,['class'=>'form-control', 'name'=>'categories[]', 'multiple' => 'true']) !!}
       </div>

       <div class="form-group">
           {!! Form::label('tags',"Tags:") !!}
           {!! Form::select('tags_array', $tags, null,['class'=>'form-control', 'name'=>'tags[]', 'multiple' => 'true']) !!}
       </div>

       <div class="form-group">
           {!! Form::label('content',"Content:") !!}
           {!! Form::textarea('content',null,['class'=>'form-control']) !!}
       </div>

       <div class="form-group">
           {!! Form::submit('Edit Post', ['class'=>'btn btn-lg btn-block btn-primary']) !!}
       </div>

       {!! Form::close() !!}

       @can('publish_post')
         {!! Form::model($post, ['method'=>'patch', 'route'=>['admin.posts.update_state', $post->id]]) !!}
            <div class="form-group">
             {!! Form::hidden('state', $state) !!}
             {!! Form::submit($buttonText, ['class'=>"btn btn-lg btn-block btn-$buttonClass"]) !!}
            </div>
         {!! Form::close() !!}
       @endcan

   </div>

@endsection
@extends('layouts.app')

@section('content')

   <div class="container">
       <h3>Posts</h3>

       <br />

       <a href="{{route('admin.posts.create')}}">Create Post</a>

       <table class="table">
           @foreach($posts as $c)
               <tr>
                   <td>{{$c->id}}</td>
                   <td>{{$c->title}}</td>
                   <td>
                            <a href="{{route('admin.posts.edit', ['id'=>$c->id])}}" id="link_edit_post_{{$c->id}}">
                                Edit
                            </a>
                        </td>
               </tr>
           @endforeach
       </table>
   </div>

@endsection
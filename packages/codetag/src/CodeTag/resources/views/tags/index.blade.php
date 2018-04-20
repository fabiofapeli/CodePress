@extends('layouts.app')
 
@section('content')
    <div class="container">
       <h3>Tags</h3>
       
       <br />
       
       <a href="{{route('admin.tags.create')}}">Create Tag</a>
       
        <table class="table">
           @foreach($tags as $tag)
               <tr>
                   <td>{{$tag->name}}</td>
               </tr>
           @endforeach
       </table>

    </div>
@endsection



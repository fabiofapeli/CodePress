@extends('layouts.app')

@section('content')

   <div class="container">
       <h3>Categories</h3>

       <br />

       <a href="{{route('admin.categories.create')}}">Create Category</a>

       <table class="table">
           @foreach($categories as $c)
               <tr>
                   <td>{{$c->name}}</td>
               </tr>
           @endforeach
       </table>
   </div>

@endsection
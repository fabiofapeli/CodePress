@extends('layouts.app')

@section('content')
@inject('appConfig', 'CodePress\CodeApp\Models\AppConfig')
   <div class="container">
       <h3>Layouts</h3>

       <br />

       <a href="{{route('admin.layouts.create')}}">Create Layout</a>

       <table class="table table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Active?</th>
              <th>Action</th>
            </tr>
          </thead>
           @foreach($layouts as $layout)
               <tr>
                   <td>{{$layout->name}}</td>
                   <td>{{ str_contains($appConfig->frontLayout, $layout->dirname) ? "Actived" : "" }}</td>
                   <td>
                        <a href="{{route('admin.layouts.active', ['id'=>$layout->id])}}">
                            Active
                        </a>
                    </td>
               </tr>
           @endforeach
       </table>
   </div>

@endsection
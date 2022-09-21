@extends('layout')
@section('title')
    All projects
@endsection
@section('content')
    {{-- check if user is admin or not  --}}
    @if (Auth::user()->is_admin == 0)
    <h2 class="text-center">
        All your tasks
    </h2>
    {{-- table of tasks --}}
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">task name</th>
          <th scope="col">employee name</th>
          <th scope="col">project name</th>
          <th scope="col">status</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($tasks as $task)
          <tr>
            <th scope="row">{{$task->id}}</th>
            <td> <a href="{{route('task.submit',$task->id)}}">{{$task->name}}</a></td>
            <td>{{$task->user->name}}</td>
            <td>{{$task->project->name}}</td>
            <td>
              @if ($task->details == Null)
              <a href="" class="btn btn-danger">
                  not submitted yet
              </a>
              @else
              <a href="" class="btn btn-success">
                  submitted
              </a>
              @endif
            </td>
          </tr>
          @endforeach
      </tbody>
    </table>
    {{-- end table of tasks --}}

    @else
    <h2 class="text-center">
        All projects
    </h2>
    {{-- display all features to admin --}}
    @foreach ($projects as $project)
    <div class="card mt-5" style="width: 70rem;">
        <div class="card-body">
          <div class="card-title">
            <a href="{{route('projects.show',$project->id)}}" >{{$project->name}}</a> 
            <p class="added-by">added by <strong>{{$project->user->name}}</strong> on {{date('jS M Y',strtotime($project->updated_at))}} </p>
          </div>
          <p class="card-text">{{$project->desc}}</p>
          <a href="{{route('projects.show',$project->id)}}" class="btn btn-primary">view</a>
          <a href="{{route('projects.edit',$project->id)}}" class="btn btn-info">edit</a>
          <a href="{{route('projects.delete',$project->id)}}" class="btn btn-danger">delete</a>
        </div>
      </div>
    @endforeach
    @endif
@endsection
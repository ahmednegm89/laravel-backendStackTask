@extends('layout')
@section('title')
    project {{$project->name}}
@endsection

@section('content')
<h2 class="text-center">
    project {{$project->name}}
</h2>
<a href="{{route('projects.edit',$project->id)}}" class="btn btn-info">edit</a>
<a href="{{route('projects.delete',$project->id)}}" class="btn btn-danger">delete</a>
<div class="mt-5">
    <h5> project name : {{$project->name}} </h5>
    <p> project description : 
        {{$project->desc}} </p>
        <h3 class="mt-5" >tasks & employees in this project:</h3>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">task name</th>
                <th scope="col">employee name</th>
                <th scope="col">Actions</th>
                <th scope="col">status</th>
                <th scope="col">details</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                  <th scope="row">{{$task->id}}</th>
                  <td>{{$task->name}}</td>
                  <td>{{$task->user->name}}</td>
                  <td>
                    <a href="{{route('tasks.edit',$task->id)}}" class="btn btn-info">update</a>
                  </td>
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
                  <td>{{$task->details}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        <h3 class="mt-5" >Assign tasks to employee :</h3>
        <form method="POST" action="{{route('task.store')}}" >
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Task name</label>
              <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            @if ($errors->any())
            @foreach ($errors->get('name') as $error)
            <p class="" style="color: red">
                <strong>{{$error}}</strong> 
            </p>
            @endforeach
            @endif
            to
            <select name="user_id" class="form-select mt-3" aria-label="Default select example">
                @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
            @if ($errors->any())
            @foreach ($errors->get('user_id') as $error)
            <p class="" style="color: red">
                <strong>{{$error}}</strong> 
            </p>
            @endforeach
            @endif
            <input type="hidden" name="project_id" value="{{$project->id}}" >
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
          </form>
</div>
@endsection
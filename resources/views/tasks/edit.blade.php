@extends('layout')
@section('title')
    edit {{$task->name}}
@endsection

@section('content')

{{-- edit task form --}}

<form method="POST" action="{{route('task.update',$task->id)}}" >
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Task name</label>
      <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$task->name}}" >
    </div>
    @if ($errors->any())
    @foreach ($errors->get('name') as $error)
    <p class="" style="color: red">
        <strong>{{$error}}</strong> 
    </p>
    @endforeach
    @endif
    reassign to 
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
    <input type="hidden" name="project_id" value="{{$task->project_id}}" >
    <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>
{{-- end edit task form --}}
@endsection
@extends('layout')
@section('title')
    submit {{$task->name}}
@endsection
@section('content')
<h2 class="text-center">
    submit task  : <strong>{{$task->name}}</strong> 
</h2>

<form method="POST" action="{{route('task.handleSubmit',$task->id)}}" >
    @csrf
    <div class="form-floating">
        <textarea class="form-control" name="details" placeholder="details" id="floatingTextarea2" style="height: 250px" >{{ old('details') }}</textarea>
        <label for="floatingTextarea2">details</label>
    </div>
    @if ($errors->any())
    @foreach ($errors->get('details') as $error)
    <p class="" style="color: red">
        <strong>{{$error}}</strong> 
    </p>
    @endforeach
    @endif
    <button type="submit" class="btn btn-primary mt-3">Submit task</button>
    <h6>Once the task submitted, it cannot be edited or resubmitted</h6>
  </form>
@endsection
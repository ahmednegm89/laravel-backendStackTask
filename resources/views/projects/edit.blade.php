@extends('layout')
@section('title')
   edit project {{$project->name}}
@endsection

@section('content')
{{-- start edit form  --}}
<form method="POST" action="{{ route('projects.update',$project->id) }}" >
  @csrf
  <div class="mb-3">
    <label for="Name" class="form-label">Name</label>
      <input type="text" name="name" class="form-control" id="Name" aria-describedby="emailHelp"  value="{{old('name') ?? $project->name}}">
    </div>
    <div class="form-floating">
      <textarea class="form-control" name="desc" placeholder="Desciption" id="floatingTextarea2" style="height: 250px"  >{{ old('desc') ?? $project->desc}}</textarea>
        <label for="floatingTextarea2">Desciption</label>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Update</button>
  </form>
  {{-- end edit form  --}}
@endsection
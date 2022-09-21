@extends('layout')
@section('title')
    Add projects
@endsection
@section('content')
{{-- create project form  --}}
<form method="POST" action="{{ route('projects.store') }}">
  @csrf
  <div class="mb-3">
      <label for="Name" class="form-label">Name</label>
      <input type="text" name="name" class="form-control" id="Name" aria-describedby="emailHelp" value="{{ old('title') }}" >
    </div>
    @if ($errors->any())
        @foreach ($errors->get('name') as $error)
        <p class="" style="color: red">
            {{$error}}
          </p>
        @endforeach
    @endif
    <div class="form-floating">
        <textarea class="form-control" name="desc" placeholder="Desciption" id="floatingTextarea2" style="height: 250px" >{{ old('desc') }}</textarea>
        <label for="floatingTextarea2">Desciption</label>
    </div>
    @if ($errors->any())
        @foreach ($errors->get('desc') as $error)
        <p class="" style="color: red">
            {{$error}}
          </p>
        @endforeach
    @endif
    <button type="submit" class="btn btn-primary mt-3">Submit</button>
  </form>
  {{-- end create project form  --}}
@endsection
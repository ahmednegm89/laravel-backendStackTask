@extends('layout')
@section('title')
    login
@endsection
@section('content')
    {{-- login form  --}}
 <div class="mt-3">
     <form method="POST" action="{{ route('auth.hlogin') }}">
        @csrf
        <div class="mb-3">
          <label for="e" class="form-label">email</label>
          <input type="email" name="email" class="form-control" id="e" aria-describedby="emailHelp" value="{{ old('email') }}" >
        </div>
        @if ($errors->any())
            @foreach ($errors->get('email') as $error)
            <p class="" style="color: red">
                <strong>{{$error}}</strong> 
            </p>
            @endforeach
        @endif
        <div class="mb-3">
          <label for="p" class="form-label">password</label>
          <input type="password" name="password" class="form-control" id="p" aria-describedby="emailHelp">
        </div>
        @if ($errors->any())
            @foreach ($errors->get('password') as $error)
            <p class="" style="color: red">
                <strong>{{$error}}</strong> 
            </p>
            @endforeach
        @endif
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
      </form>
    {{-- end login form  --}}
    </div>
@endsection
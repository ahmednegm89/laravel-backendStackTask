<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('style')
  </head>
  <body>
    @auth
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container">
        @if (Auth::user()->is_admin == 1)
        <a class="navbar-brand" href="{{route('projects.index')}}"> All projects </a>
        @else
        <a class="navbar-brand" href="{{route('projects.index')}}"> All tasks </a>
        @endif
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            @auth
            @if (Auth::user()->is_admin == 1)
            <li class="nav-item">
              <a class="nav-link" href="{{route('projects.create')}}">
                add project
              </a>
            </li>
            @endif
            @endauth
          </ul>
          <ul class="navbar-nav" style="margin-left: auto">
            @guest
              <li class="nav-item">
                <a class="nav-link active" href="{{route('auth.login')}}">Login</a>
              </li>
            @endguest
            @auth
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{Auth::user()->name}}
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('auth.logout')}}">
                          logout
                    </a></li>
                  </ul>
                </li>
              </ul>
            @endauth
          </ul>
        </div>
      </div>
  </nav>
  @endauth
    <div class="container mt-3">
    @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @yield('script')
  </body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
    @php $locale = session()->get('locale'); @endphp
    <header>
        <nav class="navbar navbar-expand-lg p-3 text-white" style="background-color: #5260A1;">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="{{route('etudiant.index')}}">Maisonneuve</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    @auth
        <div class="nav-item drops dropdown p-2" >
        <a class="nav-link" href="{{route('articles.index')}}" >Forum</a>
    </div>
    @else
    @endauth
    @auth
    <div class="nav-item drops dropdown p-2" >
      <a class="nav-link" href="{{route('documents.index')}}" >@lang('File')</a>
    </div>
    @else
    @endauth
    <div class="collapse navbar-collapse justify-content-end "  id="navbarNavAltMarkup">
        @auth
            <div class="nav-item drops dropdown p-2" >
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">@lang('Students')</a>
            <ul class="dropdown-menu dropdown-menu-end" >
              <li><a class="dropdown-item" href="{{route('etudiant.index')}}" >@lang('Student List')</a></li>
            </ul>
        </div>
        @else
        @endauth  
        <div class="nav-item drops dropdown p-2">
            @guest
            <a class="nav-link" href="{{ route('login') }}">@lang('Login')/@lang('Registration')</a>
            @else
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">{{ Auth::user()->name }}</a>
                <ul class="dropdown-menu dropdown-menu-end" >
                    <li><a class="dropdown-item" href="{{route('articles.create')}}">@lang('Add Post')</a></li>
                    <li><a class="dropdown-item" href="{{route('documents.create')}}">@lang('Add File')</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">@lang('Logout')</a></li>
                </ul>
            @endguest
        </div>
        <div class="nav-item drops dropdown p-2">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                aria-expanded="false">{{ $locale == '' ? '' : "($locale)" }}</a>
            <ul class="dropdown-menu dropdown-menu-end ">
                <li><a class="dropdown-item " href="{{ route('lang', 'en') }}">@lang('English')</a></li>
                <li><a class="dropdown-item " href="{{ route('lang', 'fr') }}">@lang('French')</a></li>
            </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
    </header>
    <div class="container flex-grow-1">
        @if(session('success'))
            <div class="alert alert-secondary alert-dismissible fade show mt-5" role="alert">
                {{ session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>      
        @endif
        @yield('content')
    </div>
    <footer class="footer mt-auto py-3 text-white" style="background-color: #5260A1;">
        <div class="container text-center">
            &copy; {{ date('Y') }} {{ config('app.name') }}. @lang('lang.text_copryright')
            <br>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </div>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
</html>
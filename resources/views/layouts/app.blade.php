<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Incidencias') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Icon -->
     <link rel="icon" type="image/png" href="{{ asset('img/icons/favicon.ico') }}"/>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/curuleam.css') }}" rel="stylesheet">

</head>
<body>
    @yield('style')
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div> 
                    <a href="{{ url('/') }}">
                    {{-- class="navbar-brand"
                        {{ config('app.name', 'Laravel') }} --}}
                        <img class="ml-0 mr-4" src="{{ asset('img/Logo.png') }}" width="40px" height="40px" alt="logo">
                    </a>
                </div>
                @auth
                <div>
                 <ul class="nav navbar-nav ml-auto">   
                        <form class="navbar-form">
                            <div class="form-group">
                                <select name="project_id" class="form-control" id="list-of-projects">
                                    @foreach (auth()->user()->list_of_projects as $project)
                                        <option 
                                            value="{{ $project->id }}" @if($project->id == auth()->user()->selected_project_id) selected @endif>{{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>                                         
                    </ul>
                </div>
                @endauth
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Center Side Of Navbar -->
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                       
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li> --}}
                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-center" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-center" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                @auth     
                        <div class="col-md-3">
                            @include('includes.menu') <!-- Menu del sistema-->
                        </div>
                    <div class="col-md-9">
                        @yield('content') <!-- Contenido de las vistas para autenticados-->
                    </div>
                @else 
                    <div class="center-block col-lg-8"> 
                        @yield('content') <!-- Contenido de las vistas para no autenticados-->
                    </div>
                @endauth 
                
            </div>
        </div>
    </div>
    
    <div class="mt-6">
        @include('includes.footer') <!-- Contenido del footer-->
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="{{ asset('js/admin/main.js') }}"></script>
    @yield('scripts') 
</body>
</html>

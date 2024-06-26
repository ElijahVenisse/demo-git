<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- CSRF Token -->
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <title>{{ config('app.name', 'PSU') }}</title>
 <!-- Scripts -->
 <script src="{{ asset('js/app.js') }}" defer></script>
 <!-- Fonts -->
 <link rel="dns-prefetch" href="//fonts.gstatic.com">
 <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
 <!-- Styles -->
 <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
 <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 <style>
   .navbar {
     height: calc(80px + 10px); /* Original height + 10px */
   }
   .navbar-brand {
     padding: 15px 20px; /* Adjust as needed */
   }
 </style>
</head>
<body>
 <div id="app">
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
   <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
    <img src="{{ asset('storage/images/logoo.png') }}" alt="PSU Logo" height="50">
 <!-- Replace "path_to_your_logo" with the actual path to your logo -->
     Pangasinan State University
    </a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
   <!-- Left Side Of Navbar -->
   <ul class="navbar-nav mr-auto">
   </ul>
    <!-- Right Side Of Navbar -->
   <ul class="navbar-nav ml-auto">
   <!-- Authentication Links -->
   @guest
   @if (Route::has('login'))
   <li class="nav-item">
    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
   </li>
   @endif
   @if (Route::has('register'))
   <!-- <li class="nav-item">
    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }} </a>
   </li> -->
   <li><a class="nav-link" href="{{ url('qrLogin') }}">Qr Login</a></li>
   @endif
   @else
    <li class="nav-item dropdown">
     <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
      <span style='color:red'>Logged</span>
      {{ Auth::user()->name }} 
     </a>
     <!-- i created a Navigate to change Page for open Scanner login -->
     <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault();
       document.getElementById('logout-form').submit();">
       {{ __('Logout') }}
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
       @csrf
      </form>
     </div>
     </li>
     @endguest
     </ul>
    </div>
   </div>
 </nav>
 <main class="py-4">
 @yield('content')
 </main>
 </div>
</body>
</html>

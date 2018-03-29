<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar-top-fixed.css') }}" rel="stylesheet">
    <link href="{{ asset('plugin/alertifyjs/css/alertify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugin/alertifyjs/css/themes/default.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <style type="text/css">
        .nav-link {
            color : #fff !important;
        }
    </style>
    @stack('css')
</head>
<body class="fuelux">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
      <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        @if(Auth::check())
        <ul class="navbar-nav mr-auto">
        <!-- Authentication Links -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('pegawai.index')}}">Pegawai </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Payroll <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('absen.index') }}">
                        Absen Pegawai
                    </a>
                    <a class="dropdown-item" href="{{ route('absen.log') }}">
                        Absen Log Mesin
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Master <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('jabatan.index') }}">
                        Jabatan
                    </a>
                    <a class="dropdown-item" href="{{ route('mesin.index') }}">
                        Mesin Fingerprint
                    </a>
                </div>
            </li>
        </ul>
        <!-- Example split danger button -->
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
            </div>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @endif
      </div>
    </nav>
    <main role="main" class="container">
        @yield('content')
    </main>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('plugin/alertifyjs/alertify.min.js') }}"></script>
    <script src="{{ asset('plugin/blockui/jquery.blockUI.min.js') }}"></script>
    @stack('scripts')
    <div class="modal hide"></div>
</body>
</html>

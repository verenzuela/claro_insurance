<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>



</head>
<body class="bg-transparent">
    <div>
        
        <div class=" container ">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">{{ __('labels.users') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('audit.index') }}">{{ __('labels.audit') }}</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ __('labels.emails') }}</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('email.index') }}" >{{ __('labels.email_list') }}</a>
                        <a class="dropdown-item" href="{{ route('email.create') }}" >{{ __('labels.email_create') }}</a>
                    </div>
                </li>

                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                 @endguest
            </ul>
        </div>
            

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script type="text/javascript">
        $('.relative.z-0.inline-flex.shadow-sm.rounded-md').remove();
    </script>
    @stack('scripts')
</body>
</html>

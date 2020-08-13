<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
    @livewireStyles

  </head>

    <body class="bg-gray-100">
        <div class="text-center flex justify-center pt-10">
            <div class="xl:w-1/3 lg:w-1/3 md:w-5/6 sm:w-5/6 rounded py-4 shadow-md bg-white">
                @yield('content')
                <div class="flex border-t justify-center items-center">
                    <div class="pt-2 w-3/6">
                    </div>
                    <div class="pt-2 w-3/6 text-right pr-4">
                        <a href="{{ url('/logout') }}"> Logout </a>
                    </div>
                </div>
            </div>
        </div>
        @livewireScripts
    </body>
    </html>

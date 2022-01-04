<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles
    @livewire('logo.colors')
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <!-- ICON -->
    <link rel="shortcut icon" href="{{asset('img/logo/SAIH-logo.png')}}"/>
</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">
        <nav x-data="{ open: false }" class="bg-white border-gray-100 bg-nav color-nav">
            <!-- Primary Navigation Menu -->
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('home') }}">
                                @livewire('logo.logo-index')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="relative min-h-screen lg:flex bg-main color-main">               
            <div class="lg:w-full">
                @if(isset($header))
                    <x-title-page>{{ $header }}</x-title-page>
                @endif
                {{ $slot }}
            </div>
        </main>
        <!-- FOOTER -->
        <footer class="text-gray-700 font-light text-sm px-3 py-2 w-full bg-nav color-nav">
            <div class="flex flex-col-reverse sm:flex-row justify-between">
                <p class="leading-8 tracking-wide">
                    Sistema SAIH-ERP. &copy; Copyright 2022. Todos los derechos reservados.
                </p>
                @if(Route::has('login'))
                    <div class="sm:px-6 flex justify-center items-center">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="text-sm text-white dark:text-gray-500 underline">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-sm text-white dark:text-gray-500 underline">Log in</a>
                        @endauth
                    </div>
                @endif
            </div>
        </footer>
    </div>

    @stack('modals')

    @livewireScripts
    @yield('js')
</body>

</html>
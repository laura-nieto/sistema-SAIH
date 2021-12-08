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
</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">
        {{-- @livewire('navigation-menu') --}}
        <nav x-data="{ open: false }" class="bg-white border-b border-gray-100 bg-nav color-nav">
            <!-- Primary Navigation Menu -->
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('dashboard') }}">
                                @livewire('logo.logo-index')
                            </a>
                            <button class="mobile-menu-button p-4 focus:outline-none ml-4">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Page Heading -->
        {{-- @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
    </div>
    </header>
    @endif--}}

    <!-- Page Content -->
    <main class="relative min-h-screen lg:flex bg-main color-main">
        <!-- SIDEBAR -->
        <div
            class="sidebar hidden bg-white w-full h-full lg:h-auto lg:w-72 space-y-6 bg-nav color-nav absolute lg:static z-10">
            <div class="h-32 p-10 border-b border-gray-300 flex flex-col items-center justify-center"
                style="background-image:url({{ asset('/img/header-purple.jpg') }});background-size:cover;">

                <h4 class="text-white text-xl font-semibold">
                    {{ Auth::user()->nombre . " " . Auth::user()->apellido }}
                </h4>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-dropdown-link
                        class="text-white hover:bg-transparent focus:border-gray-100 focus:bg-transparent"
                        href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </x-jet-dropdown-link>
                </form>

            </div>
            <!-- NAV -->
            <nav class="px-1">
                <div class="mb-6">
                    <p></p>
                    <ul>
                        <li
                            class="flex py-2.5 px-2 transition duration-200 rounded hover:bg-blue-600 hover:text-white {{ (request()->is('dashboard')) ? 'bg-blue-600 text-white' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            <a href="{{ route('dashboard') }}" class="ml-2 w-full">
                                Inicio
                            </a>
                        </li>
                    </ul>
                </div>
                <div x-data="{ isActive: false, open: false}">
                    <a href="#" @click="$event.preventDefault(); open = !open"
                        class="flex items-center p-2 rounded-md dark:text-light hover:bg-blue-100 dark:hover:bg-blue-600"
                        :class="{'bg-blue-100 dark:bg-blue-600': isActive || open}" role="button" aria-haspopup="true"
                        :aria-expanded="(open || isActive) ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd"
                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span class="ml-2 text-sm py-2.5"> ABM </span>
                        <span class="ml-auto" aria-hidden="true">
                            <!-- active class 'rotate-180' -->
                            <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </a>
                    <div role="menu" x-show="open" class="mt-2 space-y-2" aria-label="ABM">
                        <ul>
                            <li class="mb-0.5">
                                @can('admin.roles.index')
                                    <a href="{{ url('roles') }}" role="menuitem"
                                        class="block py-2.5 px-4 transition duration-200 rounded hover:bg-blue-600 hover:text-white w-full {{ (request()->is('roles')) ? 'bg-blue-600 text-white' : '' }}">Roles</a>
                                @endcan
                            </li>
                            <li class="mb-0.5">
                                @can('admin.users.index')
                                    <a href="{{ url('users') }}" role="menuitem"
                                        class="block py-2.5 px-4 transition duration-200 rounded hover:bg-blue-600 hover:text-white w-full {{ (request()->is('users')) ? 'bg-blue-600 text-white' : '' }}">Usuarios</a>
                                @endcan
                            </li>
                            <li class="mb-0.5">
                                @can('admin.servicios.index')
                                    <a href="{{ url('servicios') }}" role="menuitem"
                                        class="block py-2.5 px-4 transition duration-200 rounded hover:bg-blue-600 hover:text-white w-full {{ (request()->is('servicios')) ? 'bg-blue-600 text-white' : '' }}">Servicios</a>
                                @endcan
                            </li>
                            <li class="mb-0.5">
                                @can('admin.sucursales.index')
                                    <a href="{{ url('sucursales') }}" role="menuitem"
                                        class="block py-2.5 px-4 transition duration-200 rounded hover:bg-blue-600 hover:text-white w-full {{ (request()->is('sucursales')) ? 'bg-blue-600 text-white' : '' }}">Sucursales</a>
                                @endcan
                            </li>
                            <li class="mb-0.5">
                                @can('admin.empresas.index')
                                    <a href="{{ url('empresas') }}" role="menuitem"
                                        class="block py-2.5 px-4 transition duration-200 rounded hover:bg-blue-600 hover:text-white w-full {{ (request()->is('empresas')) ? 'bg-blue-600 text-white' : '' }}">Empresas</a>
                                @endcan
                            </li>
                            <li class="mb-0.5">
                                @can('admin.encuestas.index')
                                    <a href="{{ url('encuesta') }}" role="menuitem"
                                        class="block py-2.5 px-4 transition duration-200 rounded hover:bg-blue-600 hover:text-white w-full {{ (request()->is('encuesta')) ? 'bg-blue-600 text-white' : '' }}">Preguntas
                                        Encuesta</a>
                                @endcan
                            </li>
                            <li class="mb-0.5">
                                @can('admin.colaboradores.index')
                                    <a href="{{ url('colaboradores') }}" role="menuitem"
                                        class="block py-2.5 px-4 transition duration-200 rounded hover:bg-blue-600 hover:text-white w-full {{ (request()->is('colaboradores')) ? 'bg-blue-600 text-white' : '' }}">Colaboradores
                                    </a>
                                @endcan
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="lg:w-full">
            @if(isset($header))
                <x-title-page>{{ $header }}</x-title-page>
            @endif
            {{ $slot }}
        </div>
    </main>
    </div>

    @stack('modals')

    @livewireScripts
    <script>
        const btn = document.querySelector('.mobile-menu-button');
        const sidebar = document.querySelector('.sidebar');

        btn.addEventListener('click', () => {
            sidebar.classList.toggle('hidden')
        })
    </script>
    @yield('js')

    <footer class="border-t text-gray-700 font-light text-sm px-3 py-2 w-full">
        <div>
            <p class="leading-8 tracking-wide">
                Sistema SAIH-ERP. &copy; Copyright 2022. Todos los derechos reservados.
            </p>
        </div>
    </footer>
</body>
</html>

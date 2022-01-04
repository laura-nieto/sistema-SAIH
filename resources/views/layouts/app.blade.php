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
        {{-- @livewire('navigation-menu') --}}
        <nav x-data="{ open: false }" class="bg-white border-gray-100 bg-nav color-nav">
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

        <!-- Page Content -->
        <main class="relative min-h-screen lg:flex bg-main color-main">
            <!-- SIDEBAR -->
            <div
                class="sidebar hidden bg-white w-full lg:h-full lg:w-72 space-y-6 bg-nav color-nav absolute z-10 lg:overflow-auto" id="journal-scroll">
                <div class="h-32 p-10  border-gray-300 flex flex-col items-center justify-center"
                    style="background-image:url({{ asset('/img/header-blue.jpg') }});background-size:cover;">

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
                        <ul>
                            <li
                                class="flex py-2.5 px-2 mb-2 transition duration-200 rounded hover:bg-white hover:text-black {{ (request()->is('dashboard')) ? 'bg-white text-black' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                                <a href="{{ route('dashboard') }}" class="ml-2 w-full">
                                    Inicio
                                </a>
                            </li>

                            @can('admin.settings')
                                <li
                                    class="flex py-2.5 px-2 mb-2 transition duration-200 rounded hover:bg-white hover:text-black {{ (request()->is('themes')) ? 'bg-white text-black' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="3"></circle>
                                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1
                                        0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0
                                        0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2
                                        2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0
                                        0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1
                                        0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0
                                        0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65
                                        0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0
                                        1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0
                                        1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2
                                        0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0
                                        1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0
                                        2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0
                                        0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65
                                        1.65 0 0 0-1.51 1z"></path>
                                    </svg>
                                    <a href="{{ route('admin.settings') }}" class="ml-2 w-full">
                                        Configuración de Página
                                    </a>
                                </li>
                            @endcan
                            @can('admin.bitacora')
                                <li
                                    class="flex py-2.5 px-2 mb-2 transition duration-200 rounded hover:bg-white hover:text-black {{ (request()->is('control-de-cambios')) ? 'bg-white text-black' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <a href="{{route('admin.bitacora')}}" class="ml-2 w-full">
                                        Control de Cambios
                                    </a>
                                </li>
                            @endcan                        
                        </ul>
                    </div>
                    <div>
                        <span class="flex px-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd"
                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p>ABM</p>
                        </span>

                        <div role="menu" x-show="open" class="mt-2 space-y-2" aria-label="ABM">
                            <ul>
                                @can('admin.roles.index')
                                    <li class="mb-0.5">
                                        <a href="{{ url('roles') }}" role="menuitem"
                                            class="block py-2.5 px-4 transition duration-200 rounded hover:bg-white hover:text-black w-full {{ (request()->is('roles')) ? 'bg-white text-black' : '' }}">Roles</a>
                                    </li>
                                @endcan
                                @can('admin.users.index')
                                    <li class="mb-0.5">
                                        <a href="{{ url('users') }}" role="menuitem"
                                            class="block py-2.5 px-4 transition duration-200 rounded hover:bg-white hover:text-black w-full {{ (request()->is('users')) ? 'bg-white text-black' : '' }}">Usuarios</a>
                                    </li>
                                @endcan
                                @can('admin.servicios.index')
                                    <li class="mb-0.5">
                                        <a href="{{ url('servicios') }}" role="menuitem"
                                            class="block py-2.5 px-4 transition duration-200 rounded hover:bg-white hover:text-black w-full {{ (request()->is('servicios')) ? 'bg-white text-black' : '' }}">Servicios</a>
                                    </li>
                                @endcan
                                @can('admin.sucursales.index')
                                    <li class="mb-0.5">
                                        <a href="{{ url('sucursales') }}" role="menuitem"
                                            class="block py-2.5 px-4 transition duration-200 rounded hover:bg-white hover:text-black w-full {{ (request()->is('sucursales')) ? 'bg-white text-black' : '' }}">Sucursales</a>
                                    </li>
                                @endcan
                                @can('admin.empresas.index')
                                    <li class="mb-0.5">
                                        <a href="{{ url('empresas') }}" role="menuitem"
                                            class="block py-2.5 px-4 transition duration-200 rounded hover:bg-white hover:text-black w-full {{ (request()->is('empresas')) ? 'bg-white text-black' : '' }}">Empresas</a>
                                    </li>
                                @endcan
                                @can('admin.cuestionarios.index')
                                    <li class="mb-0.5">
                                        <a href="{{ url('cuestionario') }}" role="menuitem"
                                            class="block py-2.5 px-4 transition duration-200 rounded hover:bg-white hover:text-black w-full {{ (request()->is('cuestionario')) ? 'bg-white text-black' : '' }}">Cuestionarios
                                        </a>
                                    </li>
                                @endcan
                                @can('admin.preguntas.index')
                                    <li class="mb-0.5">
                                        <a href="{{ url('preguntas') }}" role="menuitem"
                                            class="block py-2.5 px-4 transition duration-200 rounded hover:bg-white hover:text-black w-full {{ (request()->is('encuesta')) ? 'bg-white text-black' : '' }}">Preguntas
                                            Encuesta</a>
                                    </li>
                                @endcan
                                @can('admin.colaboradores.index')
                                    <li class="mb-0.5">
                                        <a href="{{ url('colaboradores') }}" role="menuitem"
                                            class="block py-2.5 px-4 transition duration-200 rounded hover:bg-white hover:text-black w-full {{ (request()->is('colaboradores')) ? 'bg-white text-black' : '' }}">Colaboradores
                                        </a>
                                    </li>
                                @endcan
                                @can('admin.clientes.index')
                                    <li class="mb-0.5">
                                        <a href="{{ url('clientes') }}" role="menuitem"
                                            class="block py-2.5 px-4 transition duration-200 rounded hover:bg-white hover:text-black w-full {{ (request()->is('clientes')) ? 'bg-white text-black' : '' }}">Clientes
                                        </a>
                                    </li>
                                @endcan
                                @can('admin.departamento_colaborador.index')
                                    <li class="mb-0.5">
                                        <a href="{{ url('departamento/colaboradores') }}" role="menuitem"
                                            class="block py-2.5 px-4 transition duration-200 rounded hover:bg-white hover:text-black w-full {{ (request()->is('departamento/colaboradores')) ? 'bg-white text-black' : '' }}">Departamento de Colaboradores
                                        </a>
                                    </li>
                                @endcan
                                @can('admin.puesto_colaborador.index')
                                    <li class="mb-0.5">
                                        <a href="{{ url('puesto/colaboradores') }}" role="menuitem"
                                            class="block py-2.5 px-4 transition duration-200 rounded hover:bg-white hover:text-black w-full {{ (request()->is('puesto/colaboradores')) ? 'bg-white text-black' : '' }}">Puesto de Colaboradores
                                        </a>
                                    </li>
                                @endcan
                                @can('admin.tipo_membresia.index')
                                    <li class="mb-0.5">
                                        <a href="{{ url('tipo-membresia') }}" role="menuitem"
                                            class="block py-2.5 px-4 transition duration-200 rounded hover:bg-white hover:text-black w-full {{ (request()->is('tipo-membresia')) ? 'bg-white text-black' : '' }}">Tipo de Membresías
                                        </a>
                                    </li>
                                @endcan
                                @can('admin.especialidades_medicas.index')
                                    <li class="mb-0.5">
                                        <a href="{{ url('especialidad-medica') }}" role="menuitem"
                                            class="block py-2.5 px-4 transition duration-200 rounded hover:bg-white hover:text-black w-full {{ (request()->is('especialidad-medica')) ? 'bg-white text-black' : '' }}">Especialidades Médicas
                                        </a>
                                    </li>
                                @endcan
                                @can('admin.medicos.index')
                                    <li class="mb-0.5">
                                        <a href="{{ url('medicos') }}" role="menuitem"
                                            class="block py-2.5 px-4 transition duration-200 rounded hover:bg-white hover:text-black w-full {{ (request()->is('medicos')) ? 'bg-white text-black' : '' }}">Médicos
                                        </a>
                                    </li>
                                @endcan
                                @can('admin.documentacion.index')
                                    <li class="mb-0.5">
                                        <a href="{{ url('documentacion') }}" role="menuitem"
                                            class="block py-2.5 px-4 transition duration-200 rounded hover:bg-white hover:text-black w-full {{ (request()->is('documentacion')) ? 'bg-white text-black' : '' }}">Documentación</a>
                                    </li>
                                @endcan
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
        <!-- FOOTER -->
        <footer class="text-gray-700 font-light text-sm px-3 py-2 w-full bg-nav color-nav">
            <div>
                <p class="leading-8 tracking-wide">
                    Sistema SAIH-ERP. &copy; Copyright 2022. Todos los derechos reservados.
                </p>
            </div>
        </footer>
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
</body>

</html>

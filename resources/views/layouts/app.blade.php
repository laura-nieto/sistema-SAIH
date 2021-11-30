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
    @livewire('navigation-menu')
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
                class="sidebar hidden bg-white w-full h-full lg:h-auto lg:w-72 space-y-6 py-12 px-1 bg-nav color-nav absolute lg:static z-10">
                <!-- NAV -->
                <nav>
                    <div class="mb-6">
                        <p></p>
                        <ul>
                            <li class="flex py-2.5 px-2 transition duration-200 rounded hover:bg-indigo-200 hover:text-black">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                                <a href="{{ route('dashboard') }}" class="ml-2 w-full">
                                    Inicio
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="pl-2">
                        <span class="mb-1 flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                            </svg>
                            <p class="ml-2">ABM</p>
                        </span>
                        <ul>
                            <li>
                                @can('admin.roles.index')
                                    <a href="{{ url('roles') }}"
                                        class="block py-2.5 px-4 transition duration-200 rounded hover:bg-indigo-200 hover:text-black w-full">Roles</a>
                                @endcan
                            </li>
                            <li>
                                @can('admin.users.index')
                                <a href="{{ url('users') }}"
                                    class="block py-2.5 px-4 transition duration-200 rounded hover:bg-indigo-200 hover:text-black w-full">Usuarios</a>
                                @endcan
                            </li>
                            <li>
                                @can('admin.servicios.index')
                                <a href="{{ url('servicios') }}"
                                    class="block py-2.5 px-4 transition duration-200 rounded hover:bg-indigo-200 hover:text-black w-full">Servicios</a>
                                @endcan
                            </li>
                            <li>
                                @can('admin.sucursales.index')
                                <a href="{{ url('sucursales') }}"
                                    class="block py-2.5 px-4 transition duration-200 rounded hover:bg-indigo-200 hover:text-black w-full">Sucursales</a>
                                @endcan
                            </li>
                            <li>
                                @can('admin.empresas.index')
                                <a href="{{ url('empresas') }}"
                                    class="block py-2.5 px-4 transition duration-200 rounded hover:bg-indigo-200 hover:text-black w-full">Empresas</a>
                                @endcan
                            </li>
                        </ul>  
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
            //sidebar.classList.toggle('-translate-x-full')
            sidebar.classList.toggle('hidden')
        })

    </script>
    @yield('js')
</body>

</html>

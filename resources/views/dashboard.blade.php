<div class="w-full">
    <x-slot name="header">
        {{ __('Inicio') }}
    </x-slot>
    @if(session('success'))
        <x-success>{{ session('success') }}</x-success>
    @endif
    @if(session('error'))
        <x-error>{{ session('error') }}</x-error>
    @endif
    <div class="flex-1 sm:px-10 py-10 px-3">
        <div>
            <div class="grid lg:grid-cols-4 sm:grid-cols-2 md:grid-cols-3 gap-4 justify-center sm:justify-start">
                @can('admin.enviar.email')
                    <div class="flex flex-wrap">
                        <a href="{{ url('/email') }}" class="w-full">
                            <div class="min-h-full">
                                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                                    <div class="rounded-full">
                                        <img src="{{ asset('/img/email-png.png') }}" alt=""
                                            class="w-12 lg:w-16 w-min-3">
                                    </div>
                                    <div class="ml-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">Configuración y envío de correos</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan
                @can('realizar.encuesta')
                    <div class="flex flex-wrap">
                        <a href="{{ url('/elegir/encuesta') }}" class="w-full">
                            <div class="min-h-full">
                                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                                    <div class="rounded-full">
                                        <img src="{{ asset('/img/test-png.png') }}" alt=""
                                            class="w-12 lg:w-16 w-min-3">
                                    </div>
                                    <div class="ml-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">Realizar/Ver Encuesta</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan
                @can('calendario.index')
                    <div class="flex flex-wrap">
                        <a href="{{ url('/citas/mostrar') }}" class="w-full">
                            <div class="min-h-full">
                                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                                    <div class="rounded-full">
                                        <img src="{{ asset('/img/medical-png.jpg') }}" alt=""
                                            class="w-12 lg:w-16 w-min-3">
                                    </div>
                                    <div class="ml-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">Agenda de Citas/Reservaciones</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan
                @can('admin.documentacion.index')
                    <div class="flex flex-wrap">
                        <a href="{{ url('/documentacion') }}" class="w-full">
                            <div class="min-h-full">
                                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                                    <div class="rounded-full">
                                        <img src="{{ asset('/img/document-png.png') }}" alt=""
                                            class="w-12 lg:w-16 w-min-3">
                                    </div>
                                    <div class="ml-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">Subir Documentos/Expedientes</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan
                @can('reportes.index')
                    <div class="flex flex-wrap">
                        <a href="{{ url('/reportes') }}" class="w-full">
                            <div class="min-h-full">
                                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                                    <div class="rounded-full">
                                        <img src="{{ asset('/img/report-png.png') }}" alt=""
                                            class="w-12 lg:w-16 w-min-3">
                                    </div>
                                    <div class="ml-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">Reportes</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan
                {{-- @can('ver.encuesta')
                    <div class="mb-3 lg:col-start-4">
                        <a href="{{ url('/ver/encuesta') }}"
                            class="flex text-white rounded overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
                            <div class="py-3 px-4 bg-green-500 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                    <path fill-rule="evenodd"
                                        d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="px-4 py-3 bg-green-400 w-full">
                                <h5 class="text-2xl font-semibold">{{ $respuestas }}</h5>
                                <p class="font-medium">Respuestas</p>
                            </div>
                        </a>
                    </div>
                @endcan --}}
            </div>
        </div>
        <div class="mt-6 overflow-x-scroll pb-5">
            <div class="mb-2 mt-4">
                <h3 class="text-xl">Búsqueda de Colaboradores</h3>
            </div>
            <div class="flex items-center">
                {{-- SEARCH COLABORADOR --}}
                <div class="bg-white text-sm text-gray-500 font-bold shadow border-b border-gray-300 mr-3 w-96">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6 text-gray-600">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        <input type="text" wire:model.lazy="search_colaboradores" placeholder="Buscar colaborador"
                        class="pl-10 text-black focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300">
                    </div>
                </div>
                {{-- SEARCH INGRESO --}}
                <div class="bg-white text-sm text-gray-500 font-bold shadow border-b border-gray-300 mr-3 w-96">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6 text-gray-600">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        <input type="text" wire:model.lazy="search_ingreso" placeholder="Buscar Ingreso"
                        class="pl-10 text-black focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300">
                    </div>
                </div>
                {{-- SEARCH DATE --}}
                <div class="bg-white text-sm text-gray-500 font-bold shadow border-b border-gray-300 mr-3 w-96">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6 text-gray-600">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        <input type="date" wire:model.debounce.1000ms="search_date" placeholder="Buscar día"
                        class="pl-10 text-black focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300">
                    </div>
                </div>
                {{-- INGRESAR PACIENTE --}}
                @can('admin.ingresar.pacientes')
                    <div>
                        <a href="{{url('/ingresar/paciente')}}" class="px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                            Ingresar Paciente SAIH
                        </a>
                    </div>
                @endcan
            </div>
            <table class="text-black min-w-full divide-y divide-gray-200 sm:rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Colaborador ID
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Folio Tarjeta
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Nombre Colaborador
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Convenio
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Número Expediente
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            No Ingreso SAIH
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Fecha de ingreso
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Hora de ingreso
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Fecha de egreso
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Hora de egreso
                        </th>
                        {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Servicio
                        </th> --}}
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Diagnóstico
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Médico atendido
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Cliente
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Cortesía
                        </th>
                        {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Cómo nos encontró
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Detalle nos encontró
                        </th> --}}
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Venta Farmacia
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Estatus Colaborador
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if(!$ingresos->count())
                        <tr>
                            <td class="px-6 py-4 border-b-2" colspan="10">No existen ingresos con esos valores</td>
                        </tr>
                    @else
                        @foreach($ingresos as $ingreso)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{$ingreso->paciente->colaborador->id}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">                                      
                                    <div class="text-sm text-gray-900">
                                        {{ $ingreso->paciente->colaborador->folio_tarjeta }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $colaboradorReal = $ingreso->paciente->colaborador;
                                    @endphp
                                    <div class="text-sm text-gray-900 cursor-pointer" wire:click='show_colaborador({{$colaboradorReal}})'>
                                        {{ $colaboradorReal->apellido_paterno . " "  . $colaboradorReal->apellido_materno . " " . $colaboradorReal->nombre }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{$ingreso->paciente->colaborador->clientes->tipo_membresia->nombre }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">               
                                    <div class="text-sm text-gray-900"> 
                                        {{$ingreso->PacientID}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> 
                                        {{$ingreso->IngresoID}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                   <div class="text-sm text-gray-900"> 
                                        {{ Carbon\Carbon::parse($ingreso->Date_In)->format('d-m-Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> 
                                        {{ Carbon\Carbon::parse($ingreso->Hour_In)->format('H:i:s') }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> 
                                        @if($ingreso->Date_Out != null)
                                            {{ Carbon\Carbon::parse($ingreso->Date_Out)->format('d-m-Y') }}
                                        @else
                                            -
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if($ingreso->Hour_Out != null)
                                            {{ Carbon\Carbon::parse($ingreso->Hour_Out)->format('H:i:s') }}
                                        @else
                                            -
                                        @endif
                                    </div>
                                </td>
                                {{-- <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if ($search_ingreso || $search_date)
                                            asd
                                        @else
                                            servicio
                                        @endif
                                    </div>
                                </td> --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $ingreso->Diag_Desc }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{$ingreso->medico_atendido()}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $cliente = $ingreso->paciente->colaborador->clientes;
                                    @endphp
                                    <div class="text-sm text-gray-900 cursor-pointer" wire:click='show_cliente({{$cliente}})'>
                                        {{ $cliente->nombre }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $ingreso->AplicaCortesia ? 'Sí':'No' }}
                                    </div>
                                </td>
                                {{-- <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if ($search_ingreso || $search_date)
                                            {{$colaborador->como_nos_encontro()}}                                             
                                        @else
                                            @if (!$colaborador->paciente->ingresos->isEmpty())
                                                {{ $colaborador->paciente->ingresos->last()->como_nos_encontro() }}
                                            @else
                                                -
                                            @endif
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if ($search_ingreso || $search_date)
                                            {{$colaborador->detalle_encontro()}}
                                        @else
                                            @if (!$colaborador->paciente->ingresos->isEmpty())
                                                {{ $colaborador->paciente->ingresos->last()->detalle_encontro() }}
                                            @else
                                                -
                                            @endif
                                        @endif
                                    </div>
                                </td> --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if ($ingreso->venta)    
                                            <div class="md:col-span-2 justify-self-center mb-2 mt-2">
                                                <button wire:click='show_venta({{$colaborador->venta}})'
                                                class="px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                                    Ver venta
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{$ingreso->paciente->colaborador->estado === null ? '-' : $ingreso->paciente->colaborador->estado }}
                                    </div>
                                </td>
                                
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        {{-- Paginado --}}
        <div class="mt-5"> 
            {{ $ingresos->links() }}
        </div>
    </div>
    @if ($modal_colaborador)
        @include('modales-dashboard.colaborador')
    @endif
    @if ($modal_cliente)
        @include('modales-dashboard.cliente')
    @endif
    @if ($modal_venta)
        @include('modales-dashboard.venta')
    @endif
    {{-- Procesando informacion --}}
    <div wire:loading>
        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
            <!-- component -->
            <div class="flex justify-center h-screen items-center bg-gray-200 bg-opacity-75 antialiased">
                <div
                    class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg shadow-xl">
                    <div class="flex items-center justify-center w-full h-full bg-white">
                        <div class="flex justify-center items-center space-x-1 text-sm text-gray-700 p-10">
                            <svg fill='none' class="w-6 h-6 animate-spin" viewBox="0 0 32 32" xmlns='http://www.w3.org/2000/svg'>
                                <path clip-rule='evenodd'
                                    d='M15.165 8.53a.5.5 0 01-.404.58A7 7 0 1023 16a.5.5 0 011 0 8 8 0 11-9.416-7.874.5.5 0 01.58.404z'
                                    fill='currentColor' fill-rule='evenodd' />
                            </svg>
                            <div>Procesando ...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

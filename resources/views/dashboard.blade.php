<div class="w-full">
    <x-slot name="header">
        {{ __('Inicio') }}
    </x-slot>
    <div class="flex-1 sm:px-10 py-10 px-3">
        <div>
            <div class="grid lg:grid-cols-4 sm:grid-cols-2 md:grid-cols-3 gap-4 justify-center sm:justify-start">
                @can('admin.enviar.email')
                    <div class="flex flex-wrap">
                        <a href="{{ url('/enviar/email') }}" class="w-full">
                            <div class="min-h-full">
                                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                                    <div class="rounded-full">
                                        <img src="{{ asset('/img/email-png.png') }}" alt=""
                                            class="w-12 lg:w-16 w-min-3">
                                    </div>

                                    <div class="ml-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">Enviar Email</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan
                @can('realizar.encuesta')
                    <div class="flex flex-wrap">
                        <a href="{{ url('/realizar/encuesta') }}" class="w-full">
                            <div class="min-h-full">
                                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                                    <div class="rounded-full">
                                        <img src="{{ asset('/img/test-png.png') }}" alt=""
                                            class="w-12 lg:w-16 w-min-3">
                                    </div>

                                    <div class="ml-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">Realizar Encuesta</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan
                @can('realizar.encuesta')
                    <div class="flex flex-wrap">
                        <a href="{{ url('/citas') }}" class="w-full">
                            <div class="min-h-full">
                                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                                    <div class="rounded-full">
                                        <img src="{{ asset('/img/medical-png.jpg') }}" alt=""
                                            class="w-12 lg:w-16 w-min-3">
                                    </div>

                                    <div class="ml-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">Citas Médicas</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan
                @can('ver.encuesta')
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
                                <p class="font-medium">Encuestas Realizadas</p>
                            </div>
                        </a>
                    </div>
                @endcan
            </div>
        </div>
        <div class="lg:grid lg:grid-cols-6 lg:gap-4 mt-6">
            <div class="lg:col-span-3 flex flex-col">
                <div class="bg-white text-sm text-gray-500 font-bold shadow border-b border-gray-300">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6 text-gray-600">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        <input type="text" wire:model="search_colaboradores" placeholder="Buscar"
                            class="pl-10 text-black focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300">
                    </div>
                </div>
                <div class="w-full h-full overflow-auto shadow bg-white" id="journal-scroll">
                    <table class="w-full">
                        <tbody>
                            @if(!$colaboradores->count())
                                <tr>
                                    <td class="px-6 py-4 border-b-2 text-gray-800 font-medium" colspan="5">No existen colaboradores</td>
                                </tr>
                            @else
                                @foreach($colaboradores as $colaborador)
                                    <tr
                                        class="relative transform scale-100 text-xs py-1 border-b-2 cursor-default bg-opacity-25">
                                        <td class="px-3 py-2 whitespace-no-wrap">
                                            <div class="text-lg text-gray-800 font-medium">
                                                {{ $colaborador->apellido_paterno . ' ' . $colaborador->apellido_materno . ' ' . $colaborador->nombre }}
                                            </div>
                                            <div class="text-lg text-gray-500">{{ Carbon\Carbon::parse($colaborador->fecha_nacimiento)->format('d-m-Y') }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                {{-- TOKEN PARA CALENDARIO --}}
                {{-- <input type="hidden" name="_token" id="tokenCalendario" value="{{ csrf_token() }}"/>
                --}}
                {{-- <div id="citasHoy" class="lg:col-span-4"></div> --}}
                {{-- <div class="mt-3 lg:mt-0 lg:block lg:col-start-5 lg:col-span-2 md:grid md:grid-cols-4 md:gap-4"> --}}
                {{-- CARD --}}
                {{-- <div class="mb-3 md:col-span-2">
                        <a href="{{ url('/ver/encuesta') }}" class="flex text-white rounded
                overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform
                hover:scale-100
                cursor-pointer">
                <div class="py-3 px-4 bg-green-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd"
                            d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="px-4 py-3 bg-green-400 w-full">
                    <h5 class="text-2xl font-semibold">{{ $respuestas }}</h5>
                    <p class="font-medium">Encuestas Realizadas</p>
                </div>
                </a>
            </div> --}}
            {{-- CARD --}}
            {{-- </div> --}}

    </div>
        {{-- @section('js')
@if(Auth::user()->hasRole(1))
                    <script type="text/javascript">
                        const baseURL = {!! json_encode(url('/')) !!}
                        const sucursal = 1;
                    </script>
@else
                    <script type="text/javascript">
                        const baseURL = {!! json_encode(url('/')) !!}
                        const sucursal = {!! session('sucursal') !!}
                    </script>
@endif
                <script src="{{ asset('js/calendar-home.js') }}" defer></script>
        @endsection--}}
</div>

<x-app-layout>
    <div class="w-full">
        <div class="py-12 flex-1 px-2 md:px-10">
            <x-slot name="header">
                {{ __('Menú Encuestas') }}
            </x-slot>
            @if(session('success'))
                <x-success>{{ session('success') }}</x-success>
            @endif
            <x-seccion-white>
                <div class="grid sm:grid-cols-2 gap-4 justify-center">
                    @can('ver.encuesta')
                        <div class="flex flex-wrap">
                            <a href="{{ url('/ver/encuesta') }}" class="w-full">
                                <div class="min-h-full">
                                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                                        <div class="rounded-full">
                                            <img src="{{ asset('/img/test-png.png') }}" alt=""
                                                class="w-12 lg:w-16 w-min-3">
                                        </div>

                                        <div class="ml-5">
                                            <h4 class="text-2xl font-semibold text-gray-700">Ver encuestas</h4>
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
                                            <img src="{{ asset('/img/encuesta-png.png') }}" alt=""
                                                class="w-12 lg:w-16 w-min-3">
                                        </div>
                                        <div class="ml-5">
                                            <h4 class="text-2xl font-semibold text-gray-700">Realizar encuesta</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endcan
                </div>
            </x-seccion-white>
        </div>
    </div>
</x-app-layout>
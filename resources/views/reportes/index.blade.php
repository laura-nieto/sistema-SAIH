<x-app-layout>
    <div class="w-full">
        <div class="py-12 flex-1 px-2 md:px-10">
            <x-slot name="header">
                {{ __('Menú Reportes') }}
            </x-slot>
            @if(session('success'))
                <x-success>{{ session('success') }}</x-success>
            @endif
            <x-seccion-white>
                <div class="grid sm:grid-cols-2 gap-4 justify-center">
                    @can('reportes.index')
                        <div class="flex flex-wrap">
                            <a href="{{ route('reportes.ver_reportes') }}" class="w-full">
                                <div class="min-h-full">
                                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                                        <div class="rounded-full">
                                            <img src="{{ asset('/img/report-png.png') }}" alt=""
                                                class="w-12 lg:w-16 w-min-3">
                                        </div>

                                        <div class="ml-5">
                                            <h4 class="text-2xl font-semibold text-gray-700">Ver reportes</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endcan
                    @can('reportes.index')
                        <div class="flex flex-wrap">
                            <a href="{{ route('reportes.descargar') }}" class="w-full">
                                <div class="min-h-full">
                                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                                        <div class="rounded-full">
                                            <img src="{{ asset('/img/download-png.png') }}" alt=""
                                                class="w-12 lg:w-16 w-min-3">
                                        </div>
                                        <div class="ml-5">
                                            <h4 class="text-2xl font-semibold text-gray-700">Descargar reportes</h4>
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
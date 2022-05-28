<div class="w-full">
    <div class="py-12 flex-1 px-2 md:px-10">
        <x-slot name="header">
            {{ __('Registros') }}
        </x-slot>
        @if(session('success'))
            <x-success>{{ session('success') }}</x-success>
        @endif
        @if(session('error'))
            <x-error>{{ session('error') }}</x-error>
        @endif
        <x-seccion-white>
            @if ($modal)
                @include('livewire.ingreso.modal')
            @endif
            <div class="overflow-hidden sm:px-6 lg:px-8">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6 text-gray-600">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" wire:model="search" placeholder="Buscar" class="mt-1 mb-3 pl-10 text-black focus:ring-indigo-500 focus:border-indigo-500 block w-96 lg:w-1/4 shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <table class="text-black min-w-full divide-y divide-gray-200 sm:rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Cliente
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Apellido Paterno
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Apellido Materno
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Ingresar</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if(!$colaboradores->count())
                            <tr>
                                <td class="px-6 py-4 border-b-2" colspan="5">No existen colaboradores</td>
                            </tr>
                        @else
                            @foreach($colaboradores as $colaborador)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $colaborador->clientes != null ? $colaborador->clientes->nombre : '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $colaborador->apellido_paterno }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $colaborador->apellido_materno }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $colaborador->nombre }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-evenly">
                                           
                                            <button wire:click='mostrar_ingreso({{$colaborador}})'
                                                 class="px-4 py-2 mr-1 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Ingresar</button>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </x-seccion-white>
    </div>
</div>

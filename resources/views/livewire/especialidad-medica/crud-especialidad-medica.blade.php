<div class="w-full">
    <div class="py-12 flex-1 px-2 md:px-10">
        <x-slot name="header">
            {{ __('Lista de Especialidades Médicas') }}
        </x-slot>
        @if(session('success'))
            <x-success>{{ session('success') }}</x-success>
        @endif
        <x-seccion-white>
            @can('admin.especialidades_medicas.create')
                <div class="my-4 sm:px-6 lg:px-8 border-b-1 pb-3">
                    <button wire:click='crear()'
                    class="px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Crear
                    Nuevo</button>
                </div>
            @endcan
            @if ($modal)
                @include('livewire.especialidad-medica.modal-especialidad-medica')
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
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                BitCat Lugar
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Acciones</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if(!$especialidades->count())
                            <tr>
                                <td class="px-6 py-4 border-b-2" colspan="5">No existen especialidades</td>
                            </tr>
                        @else
                            @foreach($especialidades as $especialidad)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $especialidad->especialidad }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $especialidad->bitCat_lugar }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-evenly">
                                            @can('admin.especialidades_medicas.edit')
                                                <button wire:click='editar({{$especialidad->id}})'
                                                    class="px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Editar</button>
                                            @endcan
                                            @can('admin.especialidades_medicas.destroy')
                                                @if($especialidad->deleted_at == null)
                                                    <button wire:click='abrirModalDelete({{$especialidad->id}})'
                                                    class="px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Eliminar</button>
                                                @endif
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{-- Paginado --}}
                <div class="mt-5"> 
                    {{ $especialidades->links() }}
                </div>
            </div>
            <div wire:loading wire:target="save,borrar">
                <div class="fixed z-20 inset-0 overflow-y-auto ease-out duration-400">
                    <!-- component -->
                    <div class="flex justify-center h-screen items-center bg-gray-200 bg-opacity-75 antialiased">
                        <div
                            class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg shadow-xl bg-white">
                            <div class="flex items-center justify-center w-full h-full">
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
            @if($modal_delete)
                @include('livewire.modal-delete')
            @endif
        </x-sesccion-white>
    </div>
</div>
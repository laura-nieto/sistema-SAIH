<div class="w-full">
    <div class="py-12 flex-1 px-2 md:px-10">
        <x-slot name="header">
            {{ __('Configuración de Email') }}
        </x-slot>
        @if(session('success'))
            <x-success>{{ session('success') }}</x-success>
        @endif
        <x-seccion-white>
            <div class="overflow-hidden sm:px-6 lg:px-8">
                <table class="text-black min-w-full divide-y divide-gray-200 sm:rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Descripción
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Acciones</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if(!$configs->count())
                            <tr>
                                <td class="px-6 py-4 border-b-2" colspan="5">No existe configuración</td>
                            </tr>
                        @else
                            @foreach($configs as $config)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $config->descripcion }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div  x-data="{value:'{{$config->active}}', offValue: '0', onValue:'1'}">
                                            <div class="flex items-center m-2 cursor-pointer cm-toggle-wrapper"  x-on:click="value = (value == onValue ? offValue : onValue);$wire.modificar({{$config->id}},value);">
                                                <span class="font-semibold mr-1 text-gray-700">
                                                    Desactivo
                                                </span>
                                                <div class="rounded-full w-8 h-4 p-0.5" :class="{'bg-red-500': value == offValue,'bg-green-500': value == onValue}">
                                                    <div class="rounded-full w-3 h-3 bg-white transform mx-auto duration-300 ease-in-out" :class="{'-translate-x-2': value == offValue,'translate-x-2': value == onValue}"></div>
                                                </div>
                                                <span class="font-semibold ml-1 text-gray-700">
                                                    Activo
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </x-sesccion-white>
    </div>
</div>

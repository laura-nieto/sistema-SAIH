<x-app-layout>
    <div class="py-12 flex-1 p-10">
        <x-slot name="header">
            {{ $colaborador->apellido_paterno . ' ' . $colaborador->apellido_materno . ' ' . $colaborador->nombre }}
        </x-slot>
        <div class="bg-white p-3 shadow-sm rounded-sm">
            <div class="flex">
                <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                    <span>
                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>
                    <span class="tracking-wide text-lg">Información</span>
                </div>
            </div>
            <div class="text-gray-700 mt-3 divide-y divide-gray-200 text-sm md:text-base">
                <div class="grid md:grid-cols-2 mb-2">
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Nombre</div>
                        <div class="px-4 py-2">{{$colaborador->nombre}}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Apellido Paterno</div>
                        <div class="px-4 py-2">{{$colaborador->apellido_paterno}}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Apellido Materno</div>
                        <div class="px-4 py-2">{{$colaborador->apellido_materno}}</div>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 py-2">
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Género</div>
                        <div class="px-4 py-2">{{$colaborador->sexo}}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Fecha de Nacimiento</div>
                        <div class="px-4 py-2"> {{ Carbon\Carbon::parse($colaborador->fecha_nacimiento)->format('d-m-Y') }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Estado Civil</div>
                        <div class="px-4 py-2">{{$colaborador->estado_civil_r->nombre}}</div>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 py-2">
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Dirección</div>
                        <div class="px-4 py-2">{{$colaborador->direccion}}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Colonia</div>
                        <div class="px-4 py-2"> {{$colaborador->colonia}}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Ciudad</div>
                        <div class="px-4 py-2">{{$colaborador->ciudad}}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Estado</div>
                        <div class="px-4 py-2">{{$colaborador->estado}}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Pais</div>
                        <div class="px-4 py-2">{{$colaborador->pais}}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">CP</div>
                        <div class="px-4 py-2">{{$colaborador->cp}}</div>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 py-2">
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Correo Electrónico</div>
                        <div class="px-4 py-2">
                            <a class="text-blue-800" href="mailto:{{$colaborador->correo_electronico}}">{{$colaborador->correo_electronico}}</a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Teléfono</div>
                        <div class="px-4 py-2">{{$colaborador->telefono}}</div>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 py-2">
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Estado</div>
                        <div class="px-4 py-2">{{$colaborador->estado === null ? '-' : $colaborador->estado}}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Sucursal</div>
                        <div class="px-4 py-2">{{$colaborador->sucursal === null ? 'No tiene asignada una sucursal' : $colaborador->sucursal->nombre}}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Usuario</div>
                        <div class="px-4 py-2">{{$colaborador->usuario_id === null ? 'No tiene usuario' : $colaborador->usuario_id }}</div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

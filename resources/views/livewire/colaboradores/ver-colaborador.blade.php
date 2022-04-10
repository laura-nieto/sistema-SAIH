<div class="w-full">
    <div class="py-12 flex-1 px-2 md:px-10">
        <x-slot name="header">
            {{ __('Vista Colaborador') }}
        </x-slot>
        <x-seccion-white>
            @if ($modal)
                @include('livewire.colaboradores.modal-show')
            @endif
            <div>
                <ul class="flex flex-col text-gray-900">
                    {{-- INFORMACION GENERAL --}}
                    <li class="bg-white my-2 shadow-lg" x-data="accordion(1)">
                        <div class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"  @click="handleClick()">
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
                            <svg :class="handleRotate()"
                                class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                                viewBox="0 0 20 20">
                                <path
                                    d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                </path>
                            </svg>
                        </div>
                        <div x-ref="tab" :style="handleToggle()"
                            class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all">
                            <div class="text-gray-700 mt-3 divide-y divide-gray-200 text-sm md:text-base">
                                <div class="grid md:grid-cols-2 mb-2">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Nombre</div>
                                        <div class="px-4 py-2">{{ $colaborador->nombre }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Apellido Paterno</div>
                                        <div class="px-4 py-2">{{ $colaborador->apellido_paterno }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Apellido Materno</div>
                                        <div class="px-4 py-2">{{ $colaborador->apellido_materno }}</div>
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 py-2">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Género</div>
                                        <div class="px-4 py-2">{{ $colaborador->sexo }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Fecha de Nacimiento</div>
                                        <div class="px-4 py-2">
                                            {{ Carbon\Carbon::parse($colaborador->fecha_nacimiento)->format('d-m-Y') }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Estado Civil</div>
                                        <div class="px-4 py-2">{{ $colaborador->estado_civil_r->nombre }}</div>
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 py-2">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Dirección</div>
                                        <div class="px-4 py-2">{{ $colaborador->direccion }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Colonia</div>
                                        <div class="px-4 py-2"> {{ $colaborador->colonia }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Ciudad</div>
                                        <div class="px-4 py-2">{{ $colaborador->ciudad }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Estado</div>
                                        <div class="px-4 py-2">{{ $colaborador->estado }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Pais</div>
                                        <div class="px-4 py-2">{{ $colaborador->pais }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">CP</div>
                                        <div class="px-4 py-2">{{ $colaborador->cp }}</div>
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 py-2">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Correo Electrónico</div>
                                        <div class="px-4 py-2">
                                            <a class="text-blue-800"
                                                href="mailto:{{ $colaborador->correo_electronico }}">{{ $colaborador->correo_electronico }}</a>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Teléfono</div>
                                        <div class="px-4 py-2">{{ $colaborador->telefono }}</div>
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 py-2">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Estado</div>
                                        <div class="px-4 py-2">
                                            {{ $colaborador->estado === null ? '-' : $colaborador->estado }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Sucursal</div>
                                        <div class="px-4 py-2">
                                            {{ $colaborador->sucursal === null ? 'No tiene asignada una sucursal' : $colaborador->sucursal->nombre }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Usuario</div>
                                        <div class="px-4 py-2">
                                            {{ $colaborador->usuario_id === null ? 'No tiene usuario' : $colaborador->usuario_id }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    {{-- CLIENTE --}}
                    <li class="bg-white my-2 shadow-lg" x-data="accordion(2)">
                        <div class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"  @click="handleClick()">
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </span>
                                <span class="tracking-wide text-lg">Cliente</span>
                            </div>
                            <svg :class="handleRotate()"
                                class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                                viewBox="0 0 20 20">
                                <path
                                    d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                </path>
                            </svg>
                        </div>
                        <div x-ref="tab" :style="handleToggle()"
                            class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all">
                            <div class="text-gray-700 mt-3 divide-y divide-gray-200 text-sm md:text-base">
                                <div class="grid md:grid-cols-2 mb-2">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">ID</div>
                                        <div class="px-4 py-2">{{ $cliente->id }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Nombre</div>
                                        <div class="px-4 py-2">{{ $cliente->nombre }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Razón Social</div>
                                        <div class="px-4 py-2">{{ $cliente->razon_social }}</div>
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 py-2">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Dom Calle</div>
                                        <div class="px-4 py-2">{{ $cliente->dom_calle }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Dom no Exterior</div>
                                        <div class="px-4 py-2">{{ $cliente->dom_exterior }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Dom no Interior</div>
                                        <div class="px-4 py-2">{{ $cliente->dom_interior }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Dom Colonia</div>
                                        <div class="px-4 py-2">{{ $cliente->dom_colonia }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Dom Localidad</div>
                                        <div class="px-4 py-2">{{ $cliente->dom_localidad }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Dom Municipio</div>
                                        <div class="px-4 py-2">{{ $cliente->dom_municipio }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Dom Estado</div>
                                        <div class="px-4 py-2">{{ $cliente->dom_estado }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Dom País</div>
                                        <div class="px-4 py-2">{{ $cliente->dom_pais }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Dom Referencia</div>
                                        <div class="px-4 py-2">{{ $cliente->dom_referencia }}</div>
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 mb-2">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Dirección</div>
                                        <div class="px-4 py-2">{{ $cliente->direccion }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Ciudad</div>
                                        <div class="px-4 py-2">{{ $cliente->ciudad }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">RFC</div>
                                        <div class="px-4 py-2">{{ $cliente->RFC }}</div>
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 mb-2">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Número Precio</div>
                                        <div class="px-4 py-2">{{ $cliente->numero_precio }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Cobrador ID</div>
                                        <div class="px-4 py-2">{{ $cliente->cobrador_id }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Días Crédito</div>
                                        <div class="px-4 py-2">{{ $cliente->dias_credito }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Cuenta</div>
                                        <div class="px-4 py-2">{{ $cliente->cuenta }}</div>
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 mb-2">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">CP</div>
                                        <div class="px-4 py-2">{{ $cliente->cp }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Teléfono</div>
                                        <div class="px-4 py-2">{{ $cliente->telefono }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Correo Electrónico </div>
                                        <div class="px-4 py-2">{{ $cliente->correo_electronico }}</div>
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 mb-2">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Extranjero</div>
                                        <div class="px-4 py-2">
                                            {{ $cliente->extranjero ? 'Sí' : 'No' }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Descuento General</div>
                                        <div class="px-4 py-2">
                                            {{ $cliente->descuento_general ? 'Sí' : 'No' }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Membresía del Colaborador</div>
                                        <div class="px-4 py-2">{{ $cliente->tipo_membresia->nombre }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>


                {{-- PACIENTE --}}
                <div class="bg-white my-2 shadow-lg">
                    <div class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer">
                        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </span>
                            <span class="tracking-wide text-lg">Ingresos</span>
                        </div>
                    </div>
                    <div class="border-l-2 border-purple-600">
                        <div class="text-gray-700 mt-3 divide-y divide-gray-200 text-sm md:text-base">
                            <div class="mb-2">
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold text-right">Número Expediente</div>
                                    <div class="px-4 py-2">{{ $colaborador->paciente_id }}</div>
                                </div>
                            </div>
                            @foreach($ingresos as $ingreso)
                                <div class="grid md:grid-cols-2 py-2">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Número Cuenta</div>
                                        <div class="px-4 py-2">{{ $ingreso->IngresoID }}</div>
                                    </div>
                                    <br>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Fecha Ingreso</div>
                                        <div class="px-4 py-2">
                                            {{ Carbon\Carbon::parse($ingreso->Date_In)->format('d-m-Y') }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Hora Ingreso</div>
                                        <div class="px-4 py-2">
                                            {{ Carbon\Carbon::parse($ingreso->Hour_In)->format('H:m:s') }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Fecha Egreso</div>
                                        <div class="px-4 py-2">
                                            {{ Carbon\Carbon::parse($ingreso->Date_Out)->format('d-m-Y') }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Hora Egreso</div>
                                        <div class="px-4 py-2">
                                            {{ Carbon\Carbon::parse($ingreso->Hour_Out)->format('H:m:s') }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Diagnostico</div>
                                        <div class="px-4 py-2">{{ $ingreso->Diag_Desc }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Médico Atendio</div>
                                        <div class="px-4 py-2">{{ $ingreso->medico_atendido() }}</div>
                                    </div>
                                        {{-- Convenios? --}}
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Cortesía</div>
                                        <div class="px-4 py-2">{{ $ingreso->medico_atendido() }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Cómo nos encontró</div>
                                        <div class="px-4 py-2">{{ $ingreso->como_nos_encontro() }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Detalle Nos Encontró</div>
                                        <div class="px-4 py-2">{{ $ingreso->detalle_encontro() }}</div>
                                    </div>
                                    @if ($ingreso->venta)
                                        <div class="md:col-span-2 justify-self-center mb-2 mt-2">
                                            <button wire:click='show({{$ingreso}})'
                                            class="px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                                Venta
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{ $ingresos->links() }}
            </div>


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
        </x-seccion-white>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('accordion', {
                tab: 0
            });

            Alpine.data('accordion', (idx) => ({
                init() {
                    this.idx = idx;
                },
                idx: -1,
                handleClick() {
                    this.$store.accordion.tab = this.$store.accordion.tab === this.idx ? 0 : this
                        .idx;
                },
                handleRotate() {
                    return this.$store.accordion.tab === this.idx ? 'rotate-180' : '';
                },
                handleToggle() {
                    return this.$store.accordion.tab === this.idx ?
                        `max-height: ${this.$refs.tab.scrollHeight}px` : '';
                }
            }));
        })

    </script>
</div>

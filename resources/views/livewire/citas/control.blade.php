<div class="w-full">
    <div class="py-12 flex-1 px-2 md:px-10">
        <x-slot name="header">
            {{ __('Servicios Médicos') }}
        </x-slot>
        @if(session('success'))
            <x-success>Cita programada, si ingresó un correo electrónico le llegara un recordatorio.</x-success>
        @endif
        @if(session('error'))
            <x-error>{{ session('error') }}</x-error>
        @endif
        @if ($modal)
            @include('livewire.citas.modal-citas')
        @endif
        <div class="bg-white text-black px-4 py-3">
            <div class="flex flex-col md:flex-row md:items-end">
                <div class="flex flex-col mt-2 md:mt-auto md:mr-3">
                    <label class="mb-2 font-semibold text-gray-700" for="servicio">Servicios</label>
                    <select name="servicio" id="servicio" wire:model="servicio" wire:change='cambiarServicio()'
                        class="w-full bg-white text-black border border-gray-200 rounded shadow-sm appearance-none">
                        <option selected value>Seleccione un servicio</option>
                        @foreach ($servicios as $servicio)
                            <option value="{{$servicio->id}}">{{$servicio->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                @if ($mostrarSucursal)
                    <div class="flex flex-col mt-2 md:mt-auto md:mr-3">
                        <label class="mb-2 font-semibold text-gray-700" for="sucursal">Sucursal</label>
                        <select name="sucursal" id="sucursal" wire:model="sucursal" wire:change='cambiarSucursal()'
                        class="w-full bg-white text-black border border-gray-200 rounded shadow-sm appearance-none">
                            <option selected value>Seleccione un servicio</option>
                            @foreach ($sucursales as $sucursal)
                                <option value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                @if ($mostrarFecha)
                    <div class="flex flex-col mt-2 md:mt-auto md:mr-3">
                        <label class="mb-2 font-semibold text-gray-700" for="fecha">Fecha</label>
                        <input type="date" name="fecha" id="fecha" placeholder="Ingrese la fecha"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm" wire:model="fecha" wire:change='cambiarFecha()'>
                    </div>
                @endif
                @if ($mostrarHora)
                    <div class="flex flex-col mt-2 md:mt-auto md:mr-3">
                        <label class="mb-2 font-semibold text-gray-700" for="hora">Hora</label>
                        <input type="time" name="hora" id="hora" placeholder="Ingrese la hora"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm" wire:model="hora">
                    </div>
                    <button wire:click='abrirModal()'
                        class="mt-4 md:mt-auto px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                        Reservar Cita
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

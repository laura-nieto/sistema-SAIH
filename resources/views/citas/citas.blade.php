<x-app-layout>
    <x-slot name="header">
        {{ __('Calendiario') }}
    </x-slot>
    <div class="flex-1 p-10">
        <div class="w-full lg:w-3/4 lg:mx-auto">
            <div id="agenda"></div>
        </div>

        <!-- MODAL CREACION -->
        <div id="evento" class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400 hidden">
            <!-- component -->
            <div class="flex justify-center lg:h-screen items-center bg-gray-200 bg-opacity-75 antialiased">
                <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl">
                    <div
                        class="flex flex-row justify-between p-6 bg-white text-black border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                        <p class="font-semibold text-gray-800">Crear Cita</p>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                            onclick="document.getElementById('evento').classList.toggle('hidden');" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </div>
                    <div class="flex flex-col px-6 py-5 bg-gray-50">
                        <div class="bg-red-200 text-red-600 my-4 py-2 flex items-center justify-center rounded hidden" id="error">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <p class="font-bold ml-3">Algunos campos no fueron completados</p>
                        </div>
                        <form action="" id="formulario">
                            @csrf
                            <input type="hidden" name="id">
                            <div class="flex flex-col">
                                <label class="mb-2 mt-5 font-semibold text-gray-700" for="apellido">Apellido
                                    Paciente</label>
                                <input type="text" name="apellido" id="apellido" placeholder="Ingrese un apellido"
                                    class="bg-white text-black border border-gray-200 rounded shadow-sm @error('apellido')border-red-500 @enderror">
                                @error('apellido')
                                    <span class="error text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col">
                                <label class="mb-2 mt-5 font-semibold text-gray-700" for="nombre">Nombre
                                    Paciente</label>
                                <input type="text" name="nombre" id="nombre" placeholder="Ingrese un nombre"
                                    class="bg-white text-black border border-gray-200 rounded shadow-sm @error('nombre')border-red-500 @enderror">
                                @error('nombre')
                                    <span class="error text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col">
                                <label class="mb-2 mt-5 font-semibold text-gray-700" for="email">Correo Electrónico
                                    Paciente</label>
                                <input type="email" name="email" id="email" placeholder="Ingrese un correo electrónico"
                                    class="bg-white text-black border border-gray-200 rounded shadow-sm @error('email')border-red-500 @enderror">
                                @error('email')
                                    <span class="error text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col mr-3">
                                <label class="mb-2 mt-5 font-semibold text-gray-700" for="servicio_id">Servicios</label>
                                <select name="servicio_id" id="servicio_id"
                                    class="w-full bg-white text-black border border-gray-200 rounded shadow-sm appearance-none">
                                    <option selected value>Seleccione un servicio</option>
                                    @foreach ($servicios as $servicio)
                                        <option value="{{$servicio->id}}">{{$servicio->nombre}}</option>
                                    @endforeach
                                </select>
                                @error('servicio_id')
                                    <span class="error text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col">
                                <label class="mb-2 mt-5 font-semibold text-gray-700" for="start">Día</label>
                                <input type="date" name="start" id="start" placeholder="Ingrese un día"
                                    class="bg-white text-black border border-gray-200 rounded shadow-sm @error('start')border-red-500 @enderror">
                                @error('start')
                                    <span class="error text-red-500">{{ $message }}</span>
                                @enderror
                                <input type="hidden" name="end">
                            </div>
                            <div class="flex flex-col">
                                <label class="mb-2 mt-5 font-semibold text-gray-700" for="start">Hora Inicio</label>
                                <input type="time" name="hora_inicio" id="hora_inicio" placeholder="Ingrese la hora de inicio"
                                    class="bg-white text-black border border-gray-200 rounded shadow-sm @error('hora_inicio')border-red-500 @enderror">
                                @error('hora_inicio')
                                    <span class="error text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col">
                                <label class="mb-2 mt-5 font-semibold text-gray-700" for="hora_fin">Hora Fin</label>
                                <input type="time" name="hora_fin" id="hora_fin" placeholder="Ingrese la hora de fin"
                                    class="bg-white text-black border border-gray-200 rounded shadow-sm @error('hora_fin')border-red-500 @enderror">
                                @error('hora_fin')
                                    <span class="error text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-row items-center justify-end p-5 mt-3">
                                <button onclick="document.getElementById('evento').classList.toggle('hidden');"
                                    class="mr-3 px-4 py-2 font-semibold border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400"
                                    >
                                    Cancelar
                                </button>
                                <button id="btnGuardar"
                                    class="px-4 py-2 font-semibold border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Crear
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- MODAL EDICION -->
        <div id="edit" class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400 hidden">
            <!-- component -->
            <div class="flex justify-center lg:h-screen items-center bg-gray-200 bg-opacity-75 antialiased">
                <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl">
                    <div
                        class="flex flex-row justify-between p-6 bg-white text-black border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                        <p class="font-semibold text-gray-800">Editar Cita</p>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                            onclick="document.getElementById('edit').classList.toggle('hidden');" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </div>
                    <div class="flex flex-col px-6 py-5 bg-gray-50">
                        <div class="bg-red-200 text-red-600 my-4 py-2 flex items-center justify-center rounded hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <p class="font-bold ml-3">Algunos campos no fueron completados</p>
                        </div>
                        <form action="" id="formulario2">
                            @csrf
                            <input type="hidden" name="id">
                            <div class="flex flex-col">
                                <label class="mb-2 mt-5 font-semibold text-gray-700" for="apellido">Apellido
                                    Paciente</label>
                                <input type="text" name="apellido" id="apellido" placeholder="Ingrese un apellido"
                                    class="bg-white text-black border border-gray-200 rounded shadow-sm @error('apellido')border-red-500 @enderror">
                                @error('apellido')
                                    <span class="error text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col">
                                <label class="mb-2 mt-5 font-semibold text-gray-700" for="nombre">Nombre
                                    Paciente</label>
                                <input type="text" name="nombre" id="nombre" placeholder="Ingrese un nombre"
                                    class="bg-white text-black border border-gray-200 rounded shadow-sm @error('nombre')border-red-500 @enderror">
                                @error('nombre')
                                    <span class="error text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col">
                                <label class="mb-2 mt-5 font-semibold text-gray-700" for="email">Correo Electrónico
                                    Paciente</label>
                                <input type="email" name="email" id="email" placeholder="Ingrese un correo electrónico"
                                    class="bg-white text-black border border-gray-200 rounded shadow-sm @error('email')border-red-500 @enderror">
                                @error('email')
                                    <span class="error text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col">
                                <label class="mb-2 mt-5 font-semibold text-gray-700" for="servicio_id">Servicios</label>
                                <select name="servicio_id" id="servicio_id"
                                    class="w-full bg-white text-black border border-gray-200 rounded shadow-sm appearance-none">
                                    <option selected value>Seleccione un servicio</option>
                                    @foreach ($servicios as $servicio)
                                        <option value="{{$servicio->id}}">{{$servicio->nombre}}</option>
                                    @endforeach
                                </select>
                                @error('servicio_id')
                                    <span class="error text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col">
                                <label class="mb-2 mt-5 font-semibold text-gray-700" for="start">Día</label>
                                <input type="date" name="start" id="start" placeholder="Ingrese un día"
                                    class="bg-white text-black border border-gray-200 rounded shadow-sm @error('start')border-red-500 @enderror">
                                @error('start')
                                    <span class="error text-red-500">{{ $message }}</span>
                                @enderror
                                <input type="hidden" name="end">
                            </div>
                            <div class="flex flex-col">
                                <label class="mb-2 mt-5 font-semibold text-gray-700" for="start">Hora Inicio</label>
                                <input type="time" name="hora_inicio" id="hora_inicio" placeholder="Ingrese la hora de inicio"
                                    class="bg-white text-black border border-gray-200 rounded shadow-sm @error('hora_inicio')border-red-500 @enderror">
                                @error('hora_inicio')
                                    <span class="error text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col">
                                <label class="mb-2 mt-5 font-semibold text-gray-700" for="hora_fin">Hora Fin</label>
                                <input type="time" name="hora_fin" id="hora_fin" placeholder="Ingrese la hora de fin"
                                    class="bg-white text-black border border-gray-200 rounded shadow-sm @error('hora_fin')border-red-500 @enderror">
                                @error('hora_fin')
                                    <span class="error text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-row items-center justify-end p-5 mt-3">
                                <button id="btnEliminar"
                                    class="mr-3 px-4 py-2 font-semibold border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Eliminar
                                </button>
                                <button id="btnEditar"
                                    class="px-4 py-2 font-semibold border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Editar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @section('js')
        <script type="text/javascript">
            const baseURL = {!! json_encode(url('/')) !!}
            const sucursal = {!! session('sucursal') !!};
        </script>
        <script src="{{asset('js/calendar.js')}}" defer></script>
    @endsection
</x-app-layout>
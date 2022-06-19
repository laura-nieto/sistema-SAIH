<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <!-- component -->
    <div class="flex justify-center h-screen items-center bg-gray-200 bg-opacity-75 antialiased">
        <div
            class="flex flex-col w-11/12 lg:w-3/4 mx-auto rounded-lg border border-gray-300 shadow-xl">
            <div
                class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                <p class="font-semibold text-gray-800">Crear Médico</p>
                <svg wire:click="cerrarModal()" class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </div>
            <div class="flex flex-col px-6 py-5 bg-gray-50 overflow-y-auto h-90 lg:h-auto">
                <form action="" method="post" class="mb-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="doc_name">Doc Nombre</label>
                        <input type="text" name="doc_name" id="doc_name" placeholder="doc_name"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('doc_name')border-red-500 @enderror" wire:model="doc_name">
                        @error('doc_name')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="apellido_paterno">Apellido Paterno</label>
                        <input type="text" name="apellido_paterno" id="apellido_paterno" placeholder="Ingrese el apellido paterno"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('apellido_paterno')border-red-500 @enderror" wire:model="apellido_paterno">
                        @error('apellido_paterno')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="apellido_materno">Apellido Materno</label>
                        <input type="text" name="apellido_materno" id="apellido_materno" placeholder="Ingrese el apellido materno"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('apellido_materno')border-red-500 @enderror" wire:model="apellido_materno">
                        @error('apellido_materno')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('nombre')border-red-500 @enderror" wire:model="nombre">
                        @error('nombre')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="correo_electronico">Correo Electrónico</label>
                        <input type="email" name="correo_electronico" id="correo_electronico" placeholder="Ingrese el email"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('correo_electronico')border-red-500 @enderror" wire:model="correo_electronico">
                        @error('correo_electronico')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" placeholder="Ingrese el telefono"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('telefono')border-red-500 @enderror" wire:model="telefono">
                        @error('telefono')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="celular">Celular</label>
                        <input type="text" name="celular" id="celular" placeholder="Ingrese el celular"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('celular')border-red-500 @enderror" wire:model="celular">
                        @error('celular')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="cedula_profesional">Cédula Profesional</label>
                        <input type="text" name="cedula_profesional" id="cedula_profesional" placeholder="Ingrese la cédula profesional"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('cedula_profesional')border-red-500 @enderror" wire:model="cedula_profesional">
                        @error('cedula_profesional')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="especialidad_id">Especialidad</label>
                        <select name="especialidad_id" id="especialidad_id" wire:model="especialidad_id"
                            class="w-full bg-white text-black border border-gray-200 rounded shadow-sm appearance-none @error('especialidad_id')border-red-500 @enderror">
                            <option value="">Elija una especialidad</option>
                            @foreach ($especialidades as $especialidad)
                                <option value="{{$especialidad->id}}">{{$especialidad->especialidad}}</option>
                            @endforeach
                        </select>
                        @error('especialidad_id')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="cedula_especialidad">Cédula Especialidad</label>
                        <input type="text" name="cedula_especialidad" id="cedula_especialidad" placeholder="Ingrese la cédula especialidad"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('cedula_especialidad')border-red-500 @enderror" wire:model="cedula_especialidad">
                        @error('cedula_especialidad')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="ssa">SSA</label>
                        <input type="text" name="ssa" id="ssa" placeholder="Ingrese el ssa"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('ssa')border-red-500 @enderror" wire:model="ssa">
                        @error('ssa')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                </form>
                <div class="flex flex-row items-center justify-end p-5 mt-3">
                    <button
                        class="px-4 mr-3 py-2 font-semibold border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400"
                        wire:click="cerrarModal()">Cancelar</button>
                    <button wire:click.prevent='save()'
                        class="px-4 py-2 font-semibold border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Crear
                    </button>
                </div>
            </div>
        </div>
    </div>
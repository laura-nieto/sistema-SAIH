<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <!-- component -->
    <div class="flex justify-center lg:h-screen items-center bg-gray-200 bg-opacity-75 antialiased">
        <div
            class="flex flex-col w-11/12 lg:w-3/4 mx-auto rounded-lg border border-gray-300 shadow-xl">
            <div
                class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                <p class="font-semibold text-gray-800">Crear Colaborador</p>
                <svg wire:click="cerrarModal()" class="w-6 h-6 text-gray-700 cursor-pointer" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </div>
            <div class="flex flex-col px-6 py-5 bg-gray-50 overflow-y-auto h-90 lg:h-auto">
                <form action="" method="post" class="mb-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
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
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('nombre')border-red-500 @enderror" wire:model="nombre">
                        @error('nombre')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Fecha de Nacimiento" min="1940-01-01"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm w-full @error('fecha_nacimiento')border-red-500 @enderror" wire:model="fecha_nacimiento">
                        @error('fecha_nacimiento')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="sexo">Sexo</label>
                        <select name="sexo" id="sexo" wire:model="sexo"
                            class="w-full bg-white text-black border border-gray-200 rounded shadow-sm appearance-none">
                            <option selected value>Seleccione un sexo</option>
                            <option value="femenino">Femenino</option>
                            <option value="masculino">Masculino</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="estado_civil">Estado Civil</label>
                        <select name="estado_civil" id="estado_civil" wire:model="estado_civil"
                            class="w-full bg-white text-black border border-gray-200 rounded shadow-sm appearance-none">
                            <option selected value>Seleccione un estado</option>
                            @foreach ($estados_civiles as $estado)
                                <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="correo_electronico">Correo Electrónico</label>
                        <input type="email" name="correo_electronico" id="correo_electronico" placeholder="Ingrese un correo electrónico"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('correo_electronico')border-red-500 @enderror" wire:model="correo_electronico">
                        @error('correo_electronico')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" placeholder="Ingrese un teléfono"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('telefono')border-red-500 @enderror" wire:model="telefono">
                        @error('telefono')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="folio_tarjeta">Folio</label>
                        <input type="text" name="folio_tarjeta" id="folio_tarjeta" placeholder="Ingrese un folio"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('folio_tarjeta')border-red-500 @enderror" wire:model="folio_tarjeta">
                        @error('folio_tarjeta')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="direccion">Dirección</label>
                        <input type="text" name="direccion" id="direccion" placeholder="Ingrese una dirección"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('direccion')border-red-500 @enderror" wire:model="direccion">
                        @error('direccion')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="colonia">Colonia</label>
                        <input type="text" name="direccion" id="colonia" placeholder="Ingrese una colonia"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('colonia')border-red-500 @enderror" wire:model="colonia">
                        @error('colonia')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="ciudad">Ciudad</label>
                        <input type="text" name="ciudad" id="ciudad" placeholder="Ingrese una ciudad"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('ciudad')border-red-500 @enderror" wire:model="ciudad">
                        @error('ciudad')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="estado">Estado</label>
                        <input type="text" name="estado" id="estado" placeholder="Ingrese una estado"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('estado')border-red-500 @enderror" wire:model="estado">
                        @error('estado')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="pais">Pais</label>
                        <input type="text" name="pais" id="pais" placeholder="Ingrese una pais"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('pais')border-red-500 @enderror" wire:model="pais">
                        @error('pais')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="cp">CP</label>
                        <input type="text" name="cp" id="cp" placeholder="Ingrese una cp"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('cp')border-red-500 @enderror" wire:model="cp">
                        @error('cp')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="sucursal_id">Sucursal</label>
                        <select name="sucursal_id" id="sucursal_id" wire:model="sucursal_id"
                            class="w-full bg-white text-black border border-gray-200 rounded shadow-sm appearance-none">
                            <option selected value>Seleccione una sucursal</option>
                            @foreach ($sucursales as $sucursal)
                            <option value="{{$sucursal->id}}">
                                {{$sucursal->nombre}}
                            </option>
                            @endforeach
                        </select>
                        @error('sucursal_id')
                            <span class="error text-red-500 mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="usuario_id">Usuario</label>
                        <select name="usuario_id" id="usuario_id" wire:model="usuario_id"
                            class="w-full bg-white text-black border border-gray-200 rounded shadow-sm appearance-none">
                            <option selected value>Seleccione una usuario</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{$usuario->id}}">
                                    {{$usuario->apellido . " " . $usuario->nombre}}
                                </option>
                            @endforeach
                        </select>
                        @error('usuario_id')
                            <span class="error text-red-500 mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="cliente_id">Cliente</label>
                        <select name="cliente_id" id="cliente_id" wire:model="cliente_id"
                            class="w-full bg-white text-black border border-gray-200 rounded shadow-sm appearance-none">
                            <option selected value>Seleccione una cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{$cliente->id}}">
                                    {{$cliente->nombre}}
                                </option>
                            @endforeach
                        </select>
                        @error('cliente_id')
                            <span class="error text-red-500 mt-2">{{$message}}</span>
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
</div>

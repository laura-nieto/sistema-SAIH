<x-app-layout>
    <div class="py-12 flex-1 p-10">
        <x-slot name="header">
            {{ __('Crear Familiar') }}
        </x-slot>
        <x-seccion-white>
            <form action="{{ route('guardar.familiar',$colaborador) }}" method="post">
                @csrf
                <div class="text-black overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-3 gap-3 mb-3">
                            <div>
                                <label for="colaborador" class="text-sm font-bold text-gray-700">Colaborador</label>
                                <input type="text" name="colaborador" id="colaborador" disabled value="{{$colaborador->apellido_paterno . ' ' . $colaborador->nombre}}"
                                class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="cliente" class="text-sm font-bold text-gray-700">Cliente</label>
                                <input type="text" name="cliente" id="cliente" disabled value="{{$colaborador->clientes->nombre}}"
                                class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700" for="relacion">Relación</label>
                                <select name="relacion" id="relacion"
                                    class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('relacion') border-red-400 ring-red-400 @enderror">
                                    <option selected value>Seleccione un estado</option>
                                    <option value="hijo">Hijo/a</option>
                                    <option value="padre">Padre</option>
                                    <option value="esposo">Esposo/a</option>
                                </select>
                                @error('relacion')
                                    <span class="error text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            <div>
                                <label for="apellido_paterno" class="text-sm font-bold text-gray-700">Apellido Paterno</label>
                                <input type="text" name="apellido_paterno" id="apellido_paterno" placeholder="Ingrese el apellido paterno"
                                    autocomplete="given-apellido_paterno" value="{{ old('apellido_paterno') }}"
                                    class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('apellido_paterno') border-red-400 ring-red-400 @enderror">
                                @error('apellido_paterno')
                                    <span class="error text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="apellido_materno" class="text-sm font-bold text-gray-700">Apellido Materno</label>
                                <input type="text" name="apellido_materno" id="apellido_materno" placeholder="Ingrese el apellido materno"
                                    autocomplete="given-apellido_materno" value="{{ old('apellido_materno') }}"
                                    class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('apellido_materno') border-red-400 ring-red-400 @enderror">
                                @error('apellido_materno')
                                    <span class="error text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="nombre" class="text-sm font-bold text-gray-700">Nombre</label>
                                <input type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre"
                                    autocomplete="given-nombre" value="{{ old('nombre') }}"
                                    class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('nombre') border-red-400 ring-red-400 @enderror">
                                @error('nombre')
                                    <span class="error text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700" for="sexo">Sexo</label>
                                <select name="sexo" id="sexo"
                                    class="w-full mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md appearance-none @error('sexo') border-red-400 ring-red-400 @enderror">
                                    <option selected value>Seleccione un sexo</option>
                                    <option value="femenino">Femenino</option>
                                    <option value="masculino">Masculino</option>
                                </select>
                                @error('sexo')
                                    <span class="error text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="fecha_nacimiento" class="text-sm font-bold text-gray-700">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Ingrese el apellido materno"
                                    autocomplete="given-fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
                                    class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('fecha_nacimiento') border-red-400 ring-red-400 @enderror">
                                @error('fecha_nacimiento')
                                    <span class="error text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="edad" class="text-sm font-bold text-gray-700">Edad</label>
                                <input type="number" name="edad" id="edad" placeholder="Ingrese el edad"
                                    autocomplete="given-edad" value="{{ old('edad') }}"
                                    class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('edad') border-red-400 ring-red-400 @enderror">
                                @error('edad')
                                    <span class="error text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700" for="estado_civil">Estado Civil</label>
                                <select name="estado_civil" id="estado_civil"
                                    class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option selected value>Seleccione un estado</option>
                                    @foreach ($estados_civiles as $estado)
                                        <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700" for="correo_electronico">Correo Electrónico</label>
                                <input type="email" name="correo_electronico" id="correo_electronico" placeholder="Ingrese un correo electrónico"
                                    class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('correo_electronico')border-red-500 @enderror">
                                @error('correo_electronico')
                                    <span class="error text-red-500">{{$message}}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700" for="telefono">Teléfono</label>
                                <input type="text" name="telefono" id="telefono" placeholder="Ingrese un teléfono"
                                    class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('telefono')border-red-500 @enderror">
                                @error('telefono')
                                    <span class="error text-red-500">{{$message}}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700" for="folio_tarjeta">Folio</label>
                                <input type="text" name="folio_tarjeta" id="folio_tarjeta" placeholder="Ingrese un folio"
                                    class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('folio_tarjeta')border-red-500 @enderror">
                                @error('folio_tarjeta')
                                    <span class="error text-red-500">{{$message}}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700" for="direccion">Dirección</label>
                                <input type="text" name="direccion" id="direccion" placeholder="Ingrese una dirección"
                                    class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('direccion')border-red-500 @enderror">
                                @error('direccion')
                                    <span class="error text-red-500">{{$message}}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700" for="colonia">Colonia</label>
                                <input type="text" name="direccion" id="colonia" placeholder="Ingrese una colonia"
                                    class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('colonia')border-red-500 @enderror">
                                @error('colonia')
                                    <span class="error text-red-500">{{$message}}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700" for="ciudad">Ciudad</label>
                                <input type="text" name="ciudad" id="ciudad" placeholder="Ingrese una ciudad"
                                    class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('ciudad')border-red-500 @enderror">
                                @error('ciudad')
                                    <span class="error text-red-500">{{$message}}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700" for="estado">Estado</label>
                                <input type="text" name="estado" id="estado" placeholder="Ingrese una estado"
                                    class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('estado')border-red-500 @enderror">
                                @error('estado')
                                    <span class="error text-red-500">{{$message}}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700" for="pais">Pais</label>
                                <input type="text" name="pais" id="pais" placeholder="Ingrese una pais"
                                    class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('pais')border-red-500 @enderror">
                                @error('pais')
                                    <span class="error text-red-500">{{$message}}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700" for="cp">CP</label>
                                <input type="text" name="cp" id="cp" placeholder="Ingrese un cp"
                                    class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('cp')border-red-500 @enderror">
                                @error('cp')
                                    <span class="error text-red-500">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                   
                    <div class="px-4 py-4 text-right bg-white sm:px-6">
                        <a href=""
                        class="px-4 py-2 mr-3 font-semibold border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="px-4 py-2 font-semibold border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Crear
                        </button>
                    </div>
                </div>
            </form>
        </x-seccion-white>
    </div>
</x-app-layout>

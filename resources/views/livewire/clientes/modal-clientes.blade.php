<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <!-- component -->
    <div class="flex justify-center h-screen items-center bg-gray-200 bg-opacity-75 antialiased">
        <div
            class="flex flex-col w-11/12 lg:w-3/4 mx-auto rounded-lg border border-gray-300 shadow-xl">
            <div
                class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                <p class="font-semibold text-gray-800">Crear Cliente</p>
                <svg wire:click="cerrarModal()" class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </div>
            <div class="flex flex-col px-6 py-5 bg-gray-50 overflow-y-auto h-90">
                <form action="" method="post" class="mb-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('nombre')border-red-500 @enderror" wire:model="nombre">
                        @error('nombre')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div> 
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="razon_social">Razón Social</label>
                        <input type="text" name="razon_social" id="razon_social" placeholder="Ingrese la razón social"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('razon_social')border-red-500 @enderror" wire:model="razon_social">
                        @error('razon_social')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="dom_calle">Dom Calle</label>
                        <input type="text" name="dom_calle" id="dom_calle" placeholder="Ingrese el dom calle"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('dom_calle')border-red-500 @enderror" wire:model="dom_calle">
                        @error('dom_calle')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="dom_noExterior">Dom no Exterior</label>
                        <input type="text" name="dom_noExterior" id="dom_noExterior" placeholder="Ingrese el dom no exterior"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('dom_noExterior')border-red-500 @enderror" wire:model="dom_noExterior">
                        @error('dom_noExterior')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="dom_noInterior">Dom no Interior</label>
                        <input type="text" name="dom_noInterior" id="dom_noInterior" placeholder="Ingrese el dom no interior"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('dom_noInterior')border-red-500 @enderror" wire:model="dom_noInterior">
                        @error('dom_noInterior')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="dom_colonia">Dom Colonia</label>
                        <input type="text" name="dom_colonia" id="dom_colonia" placeholder="Ingrese el dom colonia"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('dom_colonia')border-red-500 @enderror" wire:model="dom_colonia">
                        @error('dom_colonia')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="dom_localidad">Dom Localidad</label>
                        <input type="text" name="dom_localidad" id="dom_localidad" placeholder="Ingrese el dom localidad"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('dom_localidad')border-red-500 @enderror" wire:model="dom_localidad">
                        @error('dom_localidad')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="dom_municipio">Dom Municipio</label>
                        <input type="text" name="dom_municipio" id="dom_municipio" placeholder="Ingrese el dom municipio"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('dom_municipio')border-red-500 @enderror" wire:model="dom_municipio">
                        @error('dom_municipio')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="dom_estado">Dom Estado</label>
                        <input type="text" name="dom_estado" id="dom_estado" placeholder="Ingrese el dom estado"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('dom_estado')border-red-500 @enderror" wire:model="dom_estado">
                        @error('dom_estado')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="dom_pais">Dom Pais</label>
                        <input type="text" name="dom_pais" id="dom_pais" placeholder="Ingrese el dom pais"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('dom_pais')border-red-500 @enderror" wire:model="dom_pais">
                        @error('dom_pais')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="dom_referencia">Dom Referencia</label>
                        <input type="text" name="dom_referencia" id="dom_referencia" placeholder="Ingrese el dom referencia"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('dom_referencia')border-red-500 @enderror" wire:model="dom_referencia">
                        @error('dom_referencia')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="ciudad">Ciudad</label>
                        <input type="text" name="ciudad" id="ciudad" placeholder="Ingrese la ciudad"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('ciudad')border-red-500 @enderror" wire:model="ciudad">
                        @error('ciudad')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="rfc">RFC</label>
                        <input type="text" name="rfc" id="rfc" placeholder="Ingrese el RFC"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('rfc')border-red-500 @enderror" wire:model="rfc">
                        @error('rfc')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="numero_precio">Número Precio</label>
                        <input type="number" name="numero_precio" id="numero_precio" placeholder="Ingrese el número-precio"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('numero_precio')border-red-500 @enderror" wire:model="numero_precio">
                        @error('numero_precio')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="cobrador_id">Cobrador</label>
                        <input type="number" name="cobrador_id" id="cobrador_id" placeholder="Ingrese el cobrador"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('cobrador_id')border-red-500 @enderror" wire:model="cobrador_id">
                        @error('cobrador_id')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="dias_credito">Días Crédito</label>
                        <input type="number" name="dias_credito" id="dias_credito" placeholder="Ingrese el número de dias credito"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('dias_credito')border-red-500 @enderror" wire:model="dias_credito">
                        @error('dias_credito')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="cuenta">Cuenta</label>
                        <input type="text" name="cuenta" id="cuenta" placeholder="Ingrese la cuenta"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('cuenta')border-red-500 @enderror" wire:model="cuenta">
                        @error('cuenta')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="cp">CP</label>
                        <input type="text" name="cp" id="cp" placeholder="Ingrese el cp"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('cp')border-red-500 @enderror" wire:model="cp">
                        @error('cp')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" placeholder="Ingrese el teléfono"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('telefono')border-red-500 @enderror" wire:model="telefono">
                        @error('telefono')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="correo_electronico">Correo Electrónico</label>
                        <input type="email" name="correo_electronico" id="correo_electronico" placeholder="Ingrese el correo electrónico"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('correo_electronico')border-red-500 @enderror" wire:model="correo_electronico">
                        @error('correo_electronico')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="tipo_cliente">Tipo Cliente</label>
                        <select name="tipo_cliente" id="tipo_cliente" wire:model="tipo_cliente"
                            class="w-full bg-white text-black border border-gray-200 rounded shadow-sm appearance-none @error('tipo_cliente')border-red-500 @enderror">
                            <option selected value>Seleccione un tipo de cliente</option>
                            @foreach ($tipo_membresias as $membresia)
                                <option value="{{$membresia->id}}">
                                    {{$membresia->nombre}}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo_cliente')
                            <span class="error text-red-500 mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col justify-end ml-3">
                        <label class="inline-flex items-center mt-3">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" wire:model="extranjero" value="1">
                            <span class="ml-2 text-gray-700">Extranjero</span>
                        </label>
                        @error('extranjero')
                            <span class="error text-red-500 mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col justify-end">
                        <label class="inline-flex items-center mt-3">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" wire:model="descuento_general" value="1">
                            <span class="ml-2 text-gray-700">Descuento General</span>
                        </label>
                        @error('descuento_general')
                            <span class="error text-red-500 mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col md:col-span-2">
                        <label class="mb-2 mt-3 font-semibold text-gray-700">Sucursales</label>
                        @foreach ($sucursales as $sucursal)
                            <label class="inline-flex items-center mt-3">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" wire:model="sucursales_id" value="{{$sucursal->id}}" name='{{$sucursal->id}}'>
                                <span class="ml-2 text-gray-700" for='{{$sucursal->id}}'>{{$sucursal->nombre}}</span>
                            </label>
                        @endforeach
                        @error('sucursales_id')
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

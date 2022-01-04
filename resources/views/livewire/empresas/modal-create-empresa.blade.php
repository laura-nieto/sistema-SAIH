<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <!-- component -->
    <div class="flex justify-center h-screen items-center bg-gray-200 bg-opacity-75 antialiased">
        <div
            class="flex flex-col w-11/12 lg:w-3/4 mx-auto rounded-lg border border-gray-300 shadow-xl">
            <div
                class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                <p class="font-semibold text-gray-800">Crear Empresa</p>
                <svg wire:click="cerrarModal()" class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </div>
            <div class="flex flex-col px-6 py-5 bg-gray-50 overflow-y-auto h-90 lg:h-auto">
                <form action="" method="post" class="mb-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('nombre')border-red-500 @enderror" wire:model="nombre">
                        @error('nombre')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="direccion">Direccion</label>
                        <input type="text" name="direccion" id="direccion" placeholder="Ingrese la direccion"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('direccion')border-red-500 @enderror" wire:model="direccion">
                        @error('direccion')
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
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="colonia">Colonia</label>
                        <input type="text" name="colonia" id="colonia" placeholder="Ingrese la colonia"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('colonia')border-red-500 @enderror" wire:model="colonia">
                        @error('colonia')
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
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" placeholder="Ingrese el teléfono"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('telefono')border-red-500 @enderror" wire:model="telefono">
                        @error('telefono')
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
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="dom_municipio">Dom Municipio</label>
                        <input type="text" name="dom_municipio" id="dom_municipio" placeholder="Ingrese el dom municipio"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('dom_municipio')border-red-500 @enderror" wire:model="dom_municipio">
                        @error('dom_municipio')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="dom_cp">Dom CP</label>
                        <input type="text" name="dom_cp" id="dom_cp" placeholder="Ingrese el dom cp"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('dom_cp')border-red-500 @enderror" wire:model="dom_cp">
                        @error('dom_cp')
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
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="nombre">Estado</label>
                        <input type="text" name="estado" id="estado" placeholder="Ingrese el estado"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('estado')border-red-500 @enderror" wire:model="estado">
                        @error('estado')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div> 
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="nombre">Representante</label>
                        <input type="text" name="representante" id="representante" placeholder="Ingrese el Representante"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('representante')border-red-500 @enderror" wire:model="representante">
                        @error('representante')
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
</div>

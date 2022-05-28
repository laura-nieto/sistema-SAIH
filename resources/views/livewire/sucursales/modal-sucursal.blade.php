<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <!-- component -->
    <div class="flex justify-center h-screen items-center bg-gray-200 bg-opacity-75 antialiased">
        <div
            class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl">
            <div
                class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                <p class="font-semibold text-gray-800">Crear Sucursal</p>
                <svg wire:click="cerrarModal()" class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </div>
            <div class="flex flex-col px-6 py-5 bg-gray-50">
                <form action="" method="post" class="mb-3">
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('nombre')border-red-500 @enderror" wire:model="nombre">
                        @error('nombre')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="ip_sucursal">IP</label>
                        <input type="text" name="ip_sucursal" id="ip_sucursal" placeholder="Ingrese el IP"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('ip_sucursal')border-red-500 @enderror" wire:model="ip_sucursal">
                        @error('ip_sucursal')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="servidor_sucursal">Servidor</label>
                        <input type="text" name="servidor_sucursal" id="servidor_sucursal" placeholder="Ingrese el servidor"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('servidor_sucursal')border-red-500 @enderror" wire:model="servidor_sucursal">
                        @error('servidor_sucursal')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="base_de_datos">Base de Datos</label>
                        <input type="text" name="base_de_datos" id="base_de_datos" placeholder="Ingrese la Base de datos"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('base_de_datos')border-red-500 @enderror" wire:model="base_de_datos">
                        @error('base_de_datos')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="conexion_ip">Conexión IP</label>
                        <input type="text" name="conexion_ip" id="conexion_ip" placeholder="Ingrese la conexión IP"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('conexion_ip')border-red-500 @enderror" wire:model="conexion_ip">
                        @error('conexion_ip')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="empresa_id">Empresa</label>
                        <select name="empresa_id" id="empresa_id" wire:model="empresa_id"
                            class="w-full bg-white text-black border border-gray-200 rounded shadow-sm appearance-none @error('empresa_id')border-red-500 @enderror">
                            <option selected value>Seleccione una empresa</option>
                            @foreach ($empresas as $empresa)
                                <option value="{{$empresa->id}}">
                                    {{$empresa->nombre}}
                                </option>
                            @endforeach
                        </select>
                        @error('empresa_id')
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
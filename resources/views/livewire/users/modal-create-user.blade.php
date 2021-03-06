<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <!-- component -->
    <div class="flex justify-center h-screen items-center bg-gray-200 bg-opacity-75 antialiased">
        <div
            class="flex flex-col w-11/12 lg:w-3/4 mx-auto rounded-lg border border-gray-300 shadow-xl">
            <div
                class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                <p class="font-semibold text-gray-800">Crear Usuario</p>
                <svg wire:click="cerrarModal()" class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </div>
            <div class="flex flex-col px-6 py-5 bg-gray-50 overflow-y-auto h-auto">
                <form action="" method="post" class="mb-3 text-black grid grid-cols-1 md:grid-cols-2 gap-3">
                    @csrf
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre"
                            class="bg-white border border-gray-200 rounded shadow-sm @error('nombre')border-red-500 @enderror" wire:model="nombre">
                        @error('nombre')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="apellido">Apellido</label>
                        <input type="text" name="apellido" id="apellido" placeholder="Apellido"
                            class="bg-white border border-gray-200 rounded shadow-sm @error('apellido')border-red-500 @enderror" wire:model="apellido">
                        @error('apellido')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email"
                            class="bg-white border border-gray-200 rounded shadow-sm @error('email')border-red-500 @enderror" wire:model="email">
                        @error('email')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="password">Contrase??a</label>
                        <input type="password" name="password" id="password" placeholder="Contrase??a"
                            class="bg-white border border-gray-200 rounded shadow-sm @error('password')border-red-500 @enderror" wire:model="password">
                        @error('password')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="rol">Rol</label>
                        <select name="rol" id="rol" wire:model="role_id"
                            class="w-full bg-white text-black border border-gray-200 rounded shadow-sm appearance-none">
                            <option>Seleccione un Rol</option>
                            @if(Auth::user()->hasRole(1))
                                @foreach ($roles as $rol)
                                    <option value="{{$rol->id}}">{{$rol->name}}</option>
                                @endforeach
                            @else
                                @foreach ($roles as $rol)
                                    @if ($rol->id != 1)
                                        <option value="{{$rol->id}}">{{$rol->name}}</option>
                                    @endif
                                @endforeach
                            @endif
                            
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="cliente">Cliente</label>
                        <select name="cliente" id="cliente_id" wire:model="cliente_id"
                            class="w-full bg-white text-black border border-gray-200 rounded shadow-sm appearance-none">
                            @if (!Auth::user()->cliente_id)    
                                <option selected value="">No corresponde</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                                @endforeach
                            @else
                                <option value="{{$clientes->id}}">{{$clientes->nombre}}</option>
                            @endif
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 mt-3 font-semibold text-gray-700">Sucursales</label>
                        @foreach ($sucursales as $sucursal)
                            <label class="inline-flex items-center mt-3">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" wire:model="sucursales_id" value="{{$sucursal->id}}" name='{{$sucursal->id}}'>
                                <span class="ml-2 text-gray-700" for="{{$sucursal->id}}">{{$sucursal->nombre}}</span>
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

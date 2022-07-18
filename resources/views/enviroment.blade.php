<x-app-layout>
    <div class="py-12 flex-1 p-10">
        <x-slot name="header">
            {{ __('Modificar Base de Datos') }}
        </x-slot>
        @if (session('success'))
            <x-success>{{session('success')}}</x-success>
        @endif
        <x-seccion-white>
            <form action="" method="post">
                @csrf
                <div class="text-black overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-3 gap-3 mb-3">
                            <div>
                                <label for="DB_HOST_SQLSERVER" class="text-sm font-bold text-gray-700">Host</label>
                                <input type="text" name="DB_HOST_SQLSERVER" id="DB_HOST_SQLSERVER" value="{{$host}}"
                                class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('DB_HOST_SQLSERVER')border-red-500 @enderror">
                                @error('DB_HOST_SQLSERVER')
                                    <span class="error text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="DB_PORT_SQLSERVER" class="text-sm font-bold text-gray-700">Puerto</label>
                                <input type="text" name="DB_PORT_SQLSERVER" id="DB_PORT_SQLSERVER" value="{{$port}}"
                                class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('DB_PORT_SQLSERVER')border-red-500 @enderror">
                                @error('DB_PORT_SQLSERVER')
                                    <span class="error text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700" for="DB_DATABASE_SQLSERVER">Nombre de la Base de Datos</label>
                                <input type="text" name="DB_DATABASE_SQLSERVER" id="DB_DATABASE_SQLSERVER" value="{{$database}}"
                                class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('DB_DATABASE_SQLSERVER')border-red-500 @enderror">
                                @error('DB_DATABASE_SQLSERVER')
                                    <span class="error text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700" for="DB_USERNAME_SQLSERVER">Usuario de la Base de Datos</label>
                                <input type="text" name="DB_USERNAME_SQLSERVER" id="DB_USERNAME_SQLSERVER" value="{{$user}}"
                                class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('DB_USERNAME_SQLSERVER')border-red-500 @enderror">
                                @error('DB_USERNAME_SQLSERVER')
                                    <span class="error text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700" for="DB_PASSWORD_SQLSERVER">Contraseña de la Base de Datos</label>
                                <input type="text" name="DB_PASSWORD_SQLSERVER" id="DB_PASSWORD_SQLSERVER" value="{{$password}}"
                                class="mt-1 mb-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('DB_PASSWORD_SQLSERVER')border-red-500 @enderror">
                                @error('DB_PASSWORD_SQLSERVER')
                                    <span class="error text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-4 text-right bg-white sm:px-6">
                        <a href="{{route('dashboard')}}"
                        class="px-4 py-2 mr-3 font-semibold border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400">
                            Cancelar
                        </a>
                        <button type="submit" onclick="return confirm('¿Está seguro que desea modificar la base de datos? La modificacion puede generar conflictos')"
                            class="px-4 py-2 font-semibold border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Modificar
                        </button>
                    </div>
                </div>
            </form>
        </x-seccion-white>
    </div>
</x-app-layout>
<div class="w-full">
    <div class="py-12 flex-1 px-2 md:px-10">
        <x-slot name="header">
            {{ __('Crear Pregunta') }}
        </x-slot>
        @if(session('success'))
            <x-success>{{ session('success') }}</x-success>
        @endif
        <x-seccion-white>
            <div class="flex flex-col px-6 py-5 bg-gray-50">
                <form action="" method="post" class="mb-3">
                    <div class="flex flex-col">
                        <label class="mb-2 mt-5 font-semibold text-gray-700" for="pregunta">Pregunta</label>
                        <input type="text" name="pregunta" id="pregunta" placeholder="Ingrese la pregunta"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('pregunta')border-red-500 @enderror" wire:model="pregunta">
                        @error('pregunta')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mt-5">
                        <div class="flex flex-col">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" wire:model="tieneOpciones" id="tieneOpciones">
                                <span class="ml-2 text-gray-700">Opciones</span>
                            </label>
                        </div>
                        <div id="opciones">
                            @foreach ($opciones as $index => $value)
                                <div class="flex flex-col">
                                    <label class="mb-2 mt-5 font-semibold text-gray-700">Opción</label>
                                    <div class="flex items-center">
                                        <input type="text" class="w-1/2 bg-white text-black border border-gray-200 rounded shadow-sm" placeholder="Ingrese la opcion" wire:model="opciones.{{$index}}">
                                        <button class="w-8 h-8 ml-3 cursor-pointer" wire:click.prevent="deleteOption({{$index}})">
                                            <div class="flex-1 h-full">
                                                <div class="flex items-center justify-center flex-1 h-full p-2 bg-red-500 text-white shadow rounded-full">
                                                    <div class="relative">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                            <button class="w-8 h-8 ml-4 mt-3 cursor-pointer @if(!$tieneOpciones) hidden @endif" wire:click.prevent="addOpcion">
                                <div class="flex-1 h-full">
                                  <div class="flex items-center justify-center flex-1 h-full p-2 bg-green-500 text-white shadow rounded-full">
                                    <div class="relative">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                      </svg>
                                    </div>
                                  </div>
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="flex flex-row items-center justify-end p-5 mt-3">
                    <button
                        class="px-4 mr-3 py-2 font-semibold border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400"
                        wire:click="regresar()">Cancelar</button>
                    <button wire:click.prevent='save()'
                        class="px-4 py-2 font-semibold border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Crear
                    </button>
                </div>
        </x-seccion-white>
    </div>
</div>

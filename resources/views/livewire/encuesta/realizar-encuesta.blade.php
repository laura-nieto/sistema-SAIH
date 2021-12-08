<div class="w-full">
    <div class="py-12 flex-1 px-2 md:px-10">
        <x-slot name="header">
            {{ __('Realizar Encuesta') }}
        </x-slot>
        <div class="flex justify-center">
            <div class="w-3/4 lg:w-1/2 bg-white p-5 rounded-xl bg-opacity-60 backdrop-filter backdrop-blur-lg">
                <form wire:submit.prevent="next">
                    <div>
                        <label class="block text-lg mb-3">{{$pregunta->pregunta}}</label>
                        <textarea wire:model="respuesta" rows="4" maxlength="210" placeholder="Ingrese una respuesta..."
                        class="block w-full mt-1 py-2 px-3 rounded-md shadow-sm focus:outline-none @error('respuesta')border-red-400 @enderror"></textarea>
                        {{-- <p class="px-2 py-1 text-xs text-white bg-blue-500 rounded right-2 bottom-2"><span id="count"></span>/210</p> --}}
                        @error('respuesta')
                            <span class="error text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex justify-end mt-5">
                        <button class="px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Siguiente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

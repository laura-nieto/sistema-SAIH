<x-slot name="header">
    {{ __('Elegir Cuestionario') }}
</x-slot>
<div class="w-full">
    <div class="py-12 px-2 md:px-10">
        <div class="flex bg-white text-black py-3">
            <div class="w-1/3 border-r-2 border-gray-400">
                <div>
                    <ul class="divide-y divide-gray-300">
                        @foreach($cuestionarios as $cuestionario)
                        <li class="p-4 cursor-pointer {{$cuestionario_id == $cuestionario->id ? 'bg-blue-200' : 'hover:bg-gray-100'}}" wire:click="change({{$cuestionario->id}})">
                            {{ $cuestionario->nombre }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="w-4/6 pl-2">
                <div>
                    @if ($preguntas != null)
                        <h5 class="my-2 text-lg font-semibold text-center">Cuestionario {{$cuestionario_id}}</h5>
                        <ol class="divide-y divide-gray-300 list-decimal list-inside">
                            @foreach($preguntas as $pregunta)
                                <li class="p-4 hover:bg-gray-50 cursor-pointer">
                                    {{$pregunta->pregunta }}
                                </li>
                            @endforeach
                        </ol>
                        <div class="px-4 mt-3 flex justify-end">
                            <button wire:click='elegir({{$cuestionario_id}})'
                            class="px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Elegir
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
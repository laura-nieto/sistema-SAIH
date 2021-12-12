<x-slot name="header">
    {{ __('Ver Encuesta') }}
</x-slot>
<div class="w-full">
    <div class="py-12 px-2 md:px-10">
        <div class="flex bg-white text-black py-3">
            <div class="w-1/3 border-r-2 border-gray-400">
                <div>
                    <ul class="divide-y divide-gray-300">
                        @foreach($preguntas as $pregunta)
                        <li class="p-4 cursor-pointer {{$pregunta_id == $pregunta->id ? 'bg-blue-200' : 'hover:bg-gray-100'}}" wire:click="change({{$pregunta->id}})">
                            {{ $pregunta->pregunta }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="w-4/6 pl-2">
                <div>
                    @if(!$respuestas->count())
                        <h5 class="p-4 text-lg font-semibold">No hay respuestas a esa pregunta</h5>
                    @else
                        <h5 class="my-2 text-lg font-semibold text-center">{{$respuestas->first()->pregunta->pregunta}}</h5>
                        <ol class="divide-y divide-gray-300 list-decimal list-inside">
                            @foreach($respuestas as $respuesta)
                            <li class="p-4 hover:bg-gray-50 cursor-pointer">
                                {{$respuesta->respuesta }}
                            </li>
                            @endforeach
                        </ol>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

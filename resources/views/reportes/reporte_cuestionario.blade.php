<x-app-layout>
    <div class="py-12 flex-1 p-10">
        <x-slot name="header">
            {{ __('Reportes cuestionario') }}
        </x-slot>
        <x-seccion-white>
            <div class="mb-2">
                <h1 class="text-xl"> Fecha: {{$fecha}} </h1>
            </div>
            <div>
                @if(!$respuestas->count())
                    <h5 class="p-4 text-lg font-semibold">No hay respuestas para la fecha</h5>
                @else
                    <table class="text-black min-w-full divide-y divide-gray-200 sm:rounded-lg">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Pregunta
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Respuesta
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($respuestas as $respuesta)
                                <tr class="even:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-gray-900">
                                            {{ $respuesta->pregunta->pregunta }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            {{ $respuesta->respuesta }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="mt-5">
                <a href="{{url('/reportes')}}" class="px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Volver
                </a>
            </div>
        </x-seccion-white>
    </div>
</x-app-layout>

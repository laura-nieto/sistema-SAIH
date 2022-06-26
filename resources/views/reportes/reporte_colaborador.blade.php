<x-app-layout>
    <div class="py-12 flex-1 p-10">
        <x-slot name="header">
            {{ __('Reportes colaborador') }}
        </x-slot>
        <x-seccion-white>
            <div class="mb-2 flex justify-between items-center">
                <h1 class="text-xl"> 
                    @if (isset($fecha))
                        Fecha: {{ $fecha }}
                    @endif
                    @if (isset($cliente))
                        Cliente: {{$cliente->nombre}}
                    @endif
                    @if (isset($doctor))
                        Médico: {{$doctor->Doc_name}}
                    @endif
                    @if (isset($diagnostico))
                        Diagnostico: {{$diagnostico->NombreDiagnostico}}
                    @endif
                </h1>
            </div>
            <div>
                @if(!$ingresos->count())
                    <h5 class="p-4 text-lg font-semibold">No hay colaboradores</h5>
                @else
                    <table class="text-black min-w-full divide-y divide-gray-200 sm:rounded-lg">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Apellido Paterno Colaborador
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Apellido Materno Colaborador
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Nombre Colaborador
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Fecha Ingreso
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Hora Ingreso
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Fecha Egreso
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Hora Egreso
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Diagnóstico
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Doctor atendido
                                </th>    
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($ingresos as $ingreso)
                                <tr class="even:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-gray-900">
                                            {{ $ingreso->paciente->colaborador->apellido_paterno }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-gray-900">
                                            {{ $ingreso->paciente->colaborador->apellido_materno }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-gray-900">
                                            {{ $ingreso->paciente->colaborador->nombre }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-gray-900">
                                            {{ Carbon\Carbon::parse($ingreso->Date_In)->format('d-m-Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-gray-900">
                                            {{ Carbon\Carbon::parse($ingreso->Hour_In)->format('H:i:s') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-gray-900">
                                            @if($ingreso->Date_Out != null)
                                                {{ Carbon\Carbon::parse($ingreso->Date_Out)->format('d-m-Y') }}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-gray-900">
                                            @if($ingreso->Hour_Out != null)
                                                {{ Carbon\Carbon::parse($ingreso->Hour_Out)->format('H:i:s') }}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-gray-900">
                                            {{ $ingreso->Diag_Desc }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-gray-900">
                                            {{ $ingreso->medico_atendido() }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div>
                @if ($ingresos->hasPages())
                    {{ $ingresos->links() }}
                @endif
            </div>
            <div class="mt-5">
                <a href="{{url('/reportes/ver')}}" class="px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Volver
                </a>
            </div>
        </x-seccion-white>
    </div>
</x-app-layout>
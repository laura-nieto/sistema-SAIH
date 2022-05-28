<x-app-layout>
    <div class="py-12 flex-1 p-10">
        <x-slot name="header">
            {{ __('Reportes') }}
        </x-slot>
        <x-seccion-white>
            <form action="" method="post" id="reportar">
                @csrf
                <div class="bg-white text-black px-4 py-3" x-data="{ tipo_reporte:0 , cuestionario:0 , colaborador:0 }">
                    <div class="flex flex-col md:flex-row md:items-end">
                        <div class="flex flex-col mt-2 md:mt-auto md:mr-3">
                            <label class="mb-2 font-semibold text-gray-700" for="tipo_reporte">Reporte</label>
                            <select name="tipo_reporte" id="tipo_reporte" x-model='tipo_reporte'
                                class="w-full bg-white text-black border border-gray-200 rounded shadow-sm appearance-none">
                                <option selected value="0" >Seleccione un reporte</option>
                                <option value="1">Colaboradores</option>
                                <option value="2">Cuestionarios</option>
                            </select>
                        </div>
                        <div class="flex flex-col mt-2 md:mt-auto md:mr-3" x-show="tipo_reporte == 1" x-transition>
                            <label class="mb-2 font-semibold text-gray-700" for="colaborador">Colaborador</label>
                            <select name="colaborador" id="colaborador" x-model='colaborador'
                                class="w-full bg-white text-black border border-gray-200 rounded shadow-sm appearance-none">
                                <option selected value="0">Seleccione un tipo de reporte</option>
                                <option value="1">Por Médico</option>
                                <option value="2">Por Cliente</option>
                                <option value="3">Por Fecha</option>
                                <option value="4">Por Diagnóstico</option>
                            </select>
                        </div>
                        <div class="flex flex-col mt-2 md:mt-auto md:mr-3" x-show="tipo_reporte == 2" x-transition>
                            <label class="mb-2 font-semibold text-gray-700" for="cuestionario">Cuestionario</label>
                            <select name="cuestionario" id="cuestionario" x-model='cuestionario'
                                class="w-full bg-white text-black border border-gray-200 rounded shadow-sm appearance-none">
                                <option selected value="0">Seleccione un tipo de reporte</option>
                                <option value="1">Por Fecha</option>
                                <option value="2">Por Cliente</option>
                            </select>
                        </div>

                        {{-- Reportes por Colaborador --}}
                        <div class="flex flex-col mt-2 md:mt-auto md:mr-3" x-show="colaborador == 2" x-transition>
                            <label class="mb-2 font-semibold text-gray-700" for="cliente">Clientes</label>
                            <select name="cliente" id="cliente"
                                class="w-full bg-white text-black border border-gray-200 rounded shadow-sm appearance-none">
                                <option selected value="0">Seleccione un cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                                @endforeach
                            </select>
                        </div>


                        {{-- Reportes por Cuestionario --}}
                        <div class="flex flex-col mt-2 md:mt-auto md:mr-3" x-show="cuestionario == 1 || colaborador == 3" x-transition>
                            <label class="mb-2 font-semibold text-gray-700" for="fecha">Ingrese la fecha</label>
                            <input type="date" name="fecha" id="fecha" placeholder="Fecha de Ingreso" min="1940-01-01"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm w-full @error('fecha')border-red-500 @enderror">
                        </div>
                    </div>
                    <div class="mt-3 flex justify-end">
                        <button id="send" @click.prevent=""
                            class="px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                            Consultar
                        </button>
                    </div>
                </div>
            </form>
        </x-seccion-white>
    </div>

    @section('js')
        <script>
            const select = document.getElementById('tipo_reporte'), 
                form = document.getElementById('reportar'),
                btn_send = document.getElementById('send')
            ;

            btn_send.addEventListener('click',function(e){
                let value = select.value;

                if (value == 1) {
                    form.action="/reportes/colaborador";
                    form.submit();
                }else if(value == 2){
                    form.action="/reportes/cuestionario";
                    form.submit();
                }else{
                    alert('error');
                }
            })
        </script>
    @endsection
    
</x-app-layout>
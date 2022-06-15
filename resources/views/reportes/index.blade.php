<x-app-layout>
    <div class="py-12 flex-1 p-10">
        <x-slot name="header">
            {{ __('Reportes') }}
        </x-slot>
        <div>
            <form action="" method="get" id="reportar">
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
                        {{-- SELECT MEDICO --}}
                        <div class="flex flex-col mt-2 md:mt-auto md:mr-3" x-show="colaborador == 1" x-transition>
                            <label class="mb-2 font-semibold text-gray-700" for="cliente">Médicos</label>
                            <input type="hidden" name="medico" id="input_medico">
                            <div
                                x-data="seleccion_buscador({ data: {{ $medicos }}, emptyOptionsMessage: 'No hay médicos con esa búsqueda.', name: 'medico', placeholder: 'Seleccione un médico', input:'input_medico' })"
                                x-init="init()"
                                @click.away="closeListbox()"
                                @keydown.escape="closeListbox()"
                                class="relative w-full"
                            >
                                <span>
                                    <div
                                        x-ref="button"
                                        @click="toggleListboxVisibility()"
                                        :aria-expanded="open"
                                        aria-haspopup="listbox"
                                        class="relative z-0 w-full py-2 pl-3 pr-10 text-left transition duration-150 ease-in-out bg-white border border-gray-200 rounded cursor-default focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
                                    >
                                        <span
                                            x-show="! open"
                                            x-text="value in options ? options[value] : placeholder"
                                            :class="{ 'text-black': ! (value in options) }"
                                            class="block truncate"
                                        ></span>
                                        <input
                                            x-ref="search"
                                            x-show="open"
                                            x-model="search"
                                            @keydown.enter.stop.prevent="selectOption()"
                                            @keydown.arrow-up.prevent="focusPreviousOption()"
                                            @keydown.arrow-down.prevent="focusNextOption()"
                                            type="search"
                                            class="w-full h-full form-control focus:outline-none"
                                        />
                                            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                                                    <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                    </div>
                                </span>
                                <div
                                    x-show="open"
                                    x-transition:leave="transition ease-in duration-100"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    x-cloak
                                    class="absolute z-10 w-full mt-1 bg-white rounded-md shadow-lg"
                                >
                                    <ul
                                        x-ref="listbox"
                                        @keydown.enter.stop.prevent="selectOption()"
                                        @keydown.arrow-up.prevent="focusPreviousOption()"
                                        @keydown.arrow-down.prevent="focusNextOption()"
                                        role="listbox"
                                        :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null"
                                        tabindex="-1"
                                        class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5"
                                    >
                                        <template x-for="(key, index) in Object.keys(options)" :key="index">
                                            <li
                                                :id="name + 'Option' + focusedOptionIndex"
                                                @click="selectOption()"
                                                @mouseenter="focusedOptionIndex = index"
                                                @mouseleave="focusedOptionIndex = null"
                                                role="option"
                                                :aria-selected="focusedOptionIndex === index"
                                                :class="{ 'text-white bg-indigo-600': index === focusedOptionIndex, 'text-gray-900': index !== focusedOptionIndex }"
                                                class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9"
                                            >
                                                <span x-text="Object.values(options)[index]"
                                                    :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !== focusedOptionIndex }"
                                                    class="block font-normal truncate"
                                                ></span>
                                                <span
                                                    x-show="key === value"
                                                    :class="{ 'text-white': index === focusedOptionIndex, 'text-indigo-600': index !== focusedOptionIndex }"
                                                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600"
                                                >
                                                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd"/>
                                                    </svg>
                                                </span>
                                            </li>
                                        </template>
                                        <div
                                            x-show="! Object.keys(options).length"
                                            x-text="emptyOptionsMessage"
                                            class="px-3 py-2 text-gray-900 cursor-default select-none"></div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{-- SELECT DIAGNOSTICO --}}
                        <div class="flex flex-col mt-2 md:mt-auto md:mr-3" x-show="colaborador == 1" x-transition>
                            <label class="mb-2 font-semibold text-gray-700" for="cliente">Diagnostico</label>
                            <input type="hidden" name="diagnostico" id="input_diagnostico">
                            <div
                                x-data="seleccion_buscador({ data: {{ $diagnostico }}, emptyOptionsMessage: 'No hay diagnosticos con esa búsqueda.', name: 'diagnostico', placeholder: 'Seleccione un diagnostico', input:'diagnostico' })"
                                x-init="init()"
                                @click.away="closeListbox()"
                                @keydown.escape="closeListbox()"
                                class="relative w-full"
                            >
                                <span>
                                    <div
                                        x-ref="button"
                                        @click="toggleListboxVisibility()"
                                        :aria-expanded="open"
                                        aria-haspopup="listbox"
                                        class="relative z-0 w-full py-2 pl-3 pr-10 text-left transition duration-150 ease-in-out bg-white border border-gray-200 rounded cursor-default focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
                                    >
                                        <span
                                            x-show="! open"
                                            x-text="value in options ? options[value] : placeholder"
                                            :class="{ 'text-black': ! (value in options) }"
                                            class="block truncate"
                                        ></span>
                                        <input
                                            x-ref="search"
                                            x-show="open"
                                            x-model="search"
                                            @keydown.enter.stop.prevent="selectOption()"
                                            @keydown.arrow-up.prevent="focusPreviousOption()"
                                            @keydown.arrow-down.prevent="focusNextOption()"
                                            type="search"
                                            class="w-full h-full form-control focus:outline-none"
                                        />
                                            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                                                    <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                    </div>
                                </span>
                                <div
                                    x-show="open"
                                    x-transition:leave="transition ease-in duration-100"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    x-cloak
                                    class="absolute z-10 w-full mt-1 bg-white rounded-md shadow-lg"
                                >
                                    <ul
                                        x-ref="listbox"
                                        @keydown.enter.stop.prevent="selectOption()"
                                        @keydown.arrow-up.prevent="focusPreviousOption()"
                                        @keydown.arrow-down.prevent="focusNextOption()"
                                        role="listbox"
                                        :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null"
                                        tabindex="-1"
                                        class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5"
                                    >
                                        <template x-for="(key, index) in Object.keys(options)" :key="index">
                                            <li
                                                :id="name + 'Option' + focusedOptionIndex"
                                                @click="selectOption()"
                                                @mouseenter="focusedOptionIndex = index"
                                                @mouseleave="focusedOptionIndex = null"
                                                role="option"
                                                :aria-selected="focusedOptionIndex === index"
                                                :class="{ 'text-white bg-indigo-600': index === focusedOptionIndex, 'text-gray-900': index !== focusedOptionIndex }"
                                                class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9"
                                            >
                                                <span x-text="Object.values(options)[index]"
                                                    :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !== focusedOptionIndex }"
                                                    class="block font-normal truncate"
                                                ></span>
                                                <span
                                                    x-show="key === value"
                                                    :class="{ 'text-white': index === focusedOptionIndex, 'text-indigo-600': index !== focusedOptionIndex }"
                                                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600"
                                                >
                                                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd"/>
                                                    </svg>
                                                </span>
                                            </li>
                                        </template>
                                        <div
                                            x-show="! Object.keys(options).length"
                                            x-text="emptyOptionsMessage"
                                            class="px-3 py-2 text-gray-900 cursor-default select-none"></div>
                                    </ul>
                                </div>
                            </div>
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
        </div>
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
        <script>
            function seleccion_buscador(config) {
                return {
                    data: config.data,
                    emptyOptionsMessage: config.emptyOptionsMessage ?? 'No results match your search.',
                    focusedOptionIndex: null,
                    name: config.name,
                    open: false,
                    options: {},
                    placeholder: config.placeholder ?? 'Select an option',
                    search: '',
                    value: config.value,
                    input: config.input,
                    closeListbox: function () {
                        this.open = false
                        this.focusedOptionIndex = null
                        this.search = ''
                    },
                    focusNextOption: function () {
                        if (this.focusedOptionIndex === null) return this.focusedOptionIndex = Object.keys(this.options).length - 1
                        if (this.focusedOptionIndex + 1 >= Object.keys(this.options).length) return
                        this.focusedOptionIndex++
                        this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                            block: "center",
                        })
                    },
                    focusPreviousOption: function () {
                        if (this.focusedOptionIndex === null) return this.focusedOptionIndex = 0
                        if (this.focusedOptionIndex <= 0) return
                        this.focusedOptionIndex--
                        this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                            block: "center",
                        })
                    },
                    init: function () {
                        this.options = this.data
                        if (!(this.value in this.options)) this.value = null
                        this.$watch('search', ((value) => {
                            if (!this.open || !value) return this.options = this.data
                            this.options = Object.keys(this.data)
                                .filter((key) => this.data[key].toLowerCase().includes(value.toLowerCase()))
                                .reduce((options, key) => {
                                    options[key] = this.data[key]
                                    return options
                                }, {})
                        }))
                    },
                    selectOption: function () {
                        if (!this.open) return this.toggleListboxVisibility()
                        this.value = Object.keys(this.options)[this.focusedOptionIndex]
                        document.getElementById(this.input).value = Object.keys(this.options)[this.focusedOptionIndex]
                        this.closeListbox()
                    },
                    toggleListboxVisibility: function () {
                        if (this.open) return this.closeListbox()
                        this.focusedOptionIndex = Object.keys(this.options).indexOf(this.value)
                        if (this.focusedOptionIndex < 0) this.focusedOptionIndex = 0
                        this.open = true
                        this.$nextTick(() => {
                            this.$refs.search.focus()
                            this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                                block: "center"
                            })
                        })
                    },
                }
            }
        </script>

    @endsection
    
</x-app-layout>
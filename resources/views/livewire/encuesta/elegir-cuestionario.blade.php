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
                        <div class="flex justify-between px-4 mt-3">
                            <div class="">
                                <label class="mb-2 font-semibold text-gray-700" for="cliente">Colaborador</label>
                                <input type="hidden" name="colaborador" id="input_colaborador">
                                <div
                                    x-data="seleccion_buscador({ data: {{ $colaboradores }}, emptyOptionsMessage: 'No hay colaborador con esa búsqueda.', name: 'colaborador', placeholder: 'Seleccione un colaborador', input:'input_colaborador' })"
                                    x-init="init()"
                                    @click.away="closeListbox()"
                                    @keydown.escape="closeListbox()"
                                    class="relative w-80"
                                >
                                    <span>
                                        <div
                                            x-ref="button"
                                            @click="toggleListboxVisibility()"
                                            :aria-expanded="open"
                                            aria-haspopup="listbox"
                                            class="relative z-0 w-full py-2 pl-3 pr-8 text-left transition duration-150 ease-in-out bg-white border border-gray-200 rounded cursor-default focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
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
                            <div class="flex justify-end">
                                <button wire:click='elegir({{$cuestionario_id}})'
                                class="px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Elegir
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
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
                    var valor = this.value
                    this.$wire.set('colaborador_id',valor,true)
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
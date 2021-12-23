<div class="py-12 flex-1 p-10">
    <x-slot name="header">
        {{ __('Enviar Email') }}
    </x-slot>
    <x-seccion-white>
        @if(session('success'))
            <x-success>{{ session('success') }}</x-success>
        @endif
        @if($errors->any())
            <x-error>Alguno de los campos no fue completado</x-error>
        @endif
        <form wire:submit.prevent="submit()" class="px-1"></form>
            @csrf
            <div class="mb-6 flex items-center">
                <div class="flex flex-col mr-8">
                    <label class="inline-flex items-center mt-3">
                        <input type="checkbox" class="form-checkbox h-4 w-4 text-gray-600" wire:model="automatizado"
                            value="1" id="automatizacion">
                        <span class="ml-2 text-white font-semibold">Automatizado</span>
                    </label>
                </div>
                <div class="flex hidden" id="time" wire:ignore>
                    <div class="flex flex-col mr-3">
                        <label class="mb-2 font-semibold text-white" for="dia">Día</label>
                        <input type="date" name="dia" id="dia" placeholder="Ingrese el día a enviar"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('dia')border-red-500 @enderror"
                            wire:model="dia">
                        @error('dia')
                            <span class="error text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 font-semibold text-white" for="hora">Hora</label>
                        <input type="time" name="hora" id="hora" placeholder="Ingrese la hora a enviar"
                            class="bg-white text-black border border-gray-200 rounded shadow-sm @error('hora')border-red-500 @enderror"
                            wire:model="hora">
                        @error('hora')
                            <span class="error text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <input type="hidden" id="content" wire:ignore wire:key="message">
            <label class="block mb-2 text-xl">Mensaje</label>
            <div wire:ignore wire:key="Themessage" class="text-black">
                <textarea id="editor" cols="30" rows="10"></textarea>
            </div>
            <div class="mt-5">
                <label class="block mb-2 text-xl">Usuarios a enviar</label>
                <div class="flex mb-3 mt-1 items-center justify-between">
                    <input type="text" wire:model="search" placeholder="Buscar"
                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-3/6 shadow-sm sm:text-sm border-gray-300 rounded-md">
                    <button wire:click="submit(document.querySelector('#content').value)"
                        class="px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Enviar
                    </button>
                </div>
                <table class="text-black min-w-full divide-y divide-gray-200 sm:rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Apellido
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Empresa
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Seleccionar
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if(!$users->count())
                            <tr>
                                <td class="px-6 py-4 border-b-2" colspan="5">No existen usuarios</td>
                            </tr>
                        @else
                            @foreach($users as $usuario)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $usuario->apellido }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $usuario->nombre }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $usuario->empresa()->exists()? $usuario->empresa->nombre : '-' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $usuario->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <label class="inline-flex items-center mt-3">
                                            <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                value="{{ $usuario->email }}" wire:model="users_enviar"><span
                                                class="ml-2 text-gray-700"></span>
                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </form>
    </x-seccion-white>
</div>
@section('js')

<script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/translations/es.js"></script>

<script type="text/javascript">
    ClassicEditor
        .create(document.querySelector('#editor'), {
            language: 'es',
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', ],
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h4',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    }
                ]
            }
        })
        .then(editor => {
            editor.model.document.on('change:data', () => {
                document.querySelector('#content').value = editor.getData();
            })
        })
        .catch(error => {
            console.log(error);
        });

    // MOSTRAR DIA - HORA 
    const auto = document.getElementById('automatizacion'),
        time = document.getElementById('time');
    auto.addEventListener('click', ()=> {
        time.classList.toggle('hidden');
    });

</script>
<style>
    :root {
        --ck-border-radius: 7px;
        --ck-color-toolbar-background: #ECFDF5;
    }

    .ck-editor__editable {
        min-height: 200px;
    }

</style>
@endsection

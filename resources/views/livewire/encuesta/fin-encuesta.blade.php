<div class="py-12">
    <x-slot name="header">
        {{ __('Realizar Encuesta') }}
    </x-slot>
    <div class="flex bg-white justify-center py-12">
        <div class="p-12 text-center max-w-2xl">
            <div class="md:text-3xl text-3xl font-bold">Ha respondido todas las preguntas</div>
            <div class="text-xl font-normal mt-4">Gracias por tomarse el tiempo de responder.
            </div>
            <div class="mt-6 flex justify-center h-12 relative">
                <div class="flex shadow-md font-medium absolute py-2 px-4 text-green-100
                cursor-pointer bg-green-600 rounded text-lg tr-mt  svelte-jqwywd"><a href="{{url('dashboard')}}">Ir al Inicio</a></div>
            </div>
        </div>
    </div>
</div>
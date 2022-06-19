<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <!-- component -->
    <div class="flex justify-center lg:h-screen items-center bg-gray-200 bg-opacity-75 antialiased">
      <div class="bg-black opacity-25 w-full h-full absolute z-10 inset-0"></div>
      <div class="bg-white rounded-lg md:max-w-md md:mx-auto p-4 fixed inset-x-0 bottom-0 z-50 mb-4 mx-4 md:relative">
        <div class="md:flex items-center">
          <div class="rounded-full border border-red-500 flex items-center justify-center w-16 h-16 flex-shrink-0 mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
          </div>
          <div class="mt-4 md:mt-0 md:ml-6 text-center md:text-left">
            <p class="font-bold text-red-700">¿Está seguro que desea eliminar?</p>
            <p class="text-sm text-gray-700 mt-1">Recuerde que los datos asociados también serán eliminados.</p>
          </div>
        </div>
        <div class="text-center md:text-right mt-4 md:flex md:justify-end">
            <button wire:click.prevent="borrar({{$delete_id}})" 
                class="block w-full md:inline-block md:w-auto px-4 py-3 md:py-2 bg-red-200 text-red-700 rounded-lg font-semibold text-sm md:ml-2 md:order-2">
                Borrar
            </button>
            <button wire:click="cerrarModal()" class="block w-full md:inline-block md:w-auto px-4 py-3 md:py-2 bg-blue-200 rounded-lg font-bold text-sm mt-4
            md:mt-0 md:order-1">Cancelar</button>
        </div>
      </div>
    </div>
</div>
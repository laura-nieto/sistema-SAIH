<div class="fixed z-10 inset-0 overflow-y-auto transition ease-out duration-400">
    <div class="flex justify-center h-screen bg-black bg-opacity-75 antialiased">
        <div class="flex flex-row max-w-3xl max-h-full">
            <img class="object-contain"
                src="{{ asset('images_documentacion/'.$documento->documento) }}"
                alt="Imágen del Documento">
            <div class="flex align-start absolute right-0">
                <button class="pt-2 pr-2 outline-none focus:outline-none" wire:click="cerrarModal()">
                    <svg class="fill-current text-white " xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

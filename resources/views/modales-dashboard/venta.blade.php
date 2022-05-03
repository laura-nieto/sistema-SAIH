<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <!-- component -->
    <div class="flex justify-center lg:h-screen items-center bg-gray-200 bg-opacity-75 antialiased">
        <div
            class="flex flex-col w-11/12 lg:w-3/4 mx-auto rounded-lg border border-gray-300 shadow-xl">
            <div
                class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                <p class="font-semibold text-gray-800">Venta de Farmacia</p>
                <svg wire:click="cerrarModal()" class="w-6 h-6 text-gray-800 cursor-pointer" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </div>
            <div class="flex flex-col px-6 py-5 bg-gray-50 overflow-y-auto h-90 lg:h-auto text-gray-900">
                <div class="grid md:grid-cols-2 py-2" id="stripped">
                    <style>
                        #stripped>div:nth-child(4n),#stripped>div:nth-child(4n+1){
                            background-color:  rgba(243, 244, 246, 1);
                        }
                    </style>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Id de venta</div>
                        <div>{{ $id_venta }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Número de ventaa</div>
                        <div>{{ $NoVenta }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Nombre de persona venta</div>
                        <div>{{ $NombrePersonaVenta }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Fecha de venta</div>
                        <div>
                            {{ Carbon\Carbon::parse($Fecha_venta)->format('d-m-Y') }}
                        </div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Hora de venta</div>
                        <div>
                            {{ Carbon\Carbon::parse($Hora_venta)->format('H:m:s') }}
                        </div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Total Productos</div>
                        <div>{{ $TotalProductos }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Subtotal</div>
                        <div>{{ $TotalSubtotal }}</div>
                    </div>
                    {{-- Convenios? --}}
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">IVA</div>
                        <div>{{ $TotalIva }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Total</div>
                        <div>{{ $TotalVenta }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Usuario ID</div>
                        <div>{{ $UsuarioID }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Estatus</div>
                        <div>{{ $Estatus }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Facturado Pac</div>
                        <div>{{ $FacturadoPac ? 'Sí':'No' }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Cancelado</div>
                        <div>{{ $Cancelada ? 'Sí':'No' }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Cerrado</div>
                        <div>{{ $Cerrado ? 'Sí':'No' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
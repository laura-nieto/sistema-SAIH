<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <!-- component -->
    <div class="flex justify-center lg:h-screen items-center bg-gray-200 bg-opacity-75 antialiased">
        <div class="flex flex-col w-11/12 lg:w-3/4 mx-auto rounded-lg border border-gray-300 shadow-xl">
            <div
                class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                <p class="font-semibold text-gray-800">Cliente</p>
                <svg wire:click="cerrarModal()" class="w-6 h-6 text-gray-700 cursor-pointer" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </div>
            <div class="flex flex-col px-6 py-5 bg-gray-50 overflow-y-auto h-90 lg:h-auto">
                <div class="mb-3 grid grid-cols-1 md:grid-cols-2 text-gray-700" id="stripped">
                    <style>
                        #stripped>div:nth-child(4n),#stripped>div:nth-child(4n+1){
                            background-color:  rgba(243, 244, 246, 1);
                        }
                    </style>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Cliente ID:</div>
                        <div>{{ $cliente_id }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Nombre Cliente:</div>
                        <div>{{ $nombre_cliente }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Razón Social:</div>
                        <div>{{ $razon_social }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Dom Calle:</div>
                        <div>{{ $dom_calle }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Dom no Exterior:</div>
                        <div>{{ $dom_noExterior }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Dom no Interior:</div>
                        <div>{{ $dom_noInterior }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Dom Colonia:</div>
                        <div>{{ $dom_colonia }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Dom Localidad:</div>
                        <div>{{ $dom_localidad }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Dom Municipio:</div>
                        <div>{{ $dom_municipio }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Dom Estado:</div>
                        <div>{{ $dom_estado }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Dom Pais:</div>
                        <div>{{ $dom_pais }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Dom Referencia:</div>
                        <div>{{ $dom_referencia }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Direccion:</div>
                        <div>{{ $direccion }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Ciudad:</div>
                        <div>{{ $ciudad }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">RFC:</div>
                        <div>{{ $rfc }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Número Precio:</div>
                        <div>{{ $numero_precio }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Cobrador ID:</div>
                        <div>{{ $cobrador_id }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Días Credito:</div>
                        <div>{{ $dias_credito }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Cuenta:</div>
                        <div>{{ $cuenta }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">CP:</div>
                        <div>{{ $cp }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Teléfono:</div>
                        <div>{{ $telefono_cliente }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-4">
                        <div class="font-semibold">Correo Electrónico:</div>
                        <div>{{ $correo_electronico_cliente }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

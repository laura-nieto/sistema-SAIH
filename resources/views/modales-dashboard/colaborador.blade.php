<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <!-- component -->
    <div class="flex justify-center lg:h-screen items-center bg-gray-200 bg-opacity-75 antialiased">
        <div
            class="flex flex-col w-11/12 lg:w-3/4 mx-auto rounded-lg border border-gray-300 shadow-xl">
            <div
                class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                <p class="font-semibold text-gray-800">Colaborador</p>
                <svg wire:click="cerrarModal()" class="w-6 h-6 text-gray-700 cursor-pointer" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </div>
            <div class="flex flex-col px-6 py-5 bg-gray-50 overflow-y-auto h-90 lg:h-auto">
                <table>
                    <tbody class="text-gray-700">
                        <tr>
                            <td class="w-1/3 text-left py-3 px-4">Colaborador ID</td>
                            <td class="w-1/3 text-left py-3 px-4">{{$colaborador_id}}</td>
                        </tr>
                        <tr class="bg-gray-100">
                            <td class="w-1/3 text-left py-3 px-4">Folio</td>
                            <td class="w-1/3 text-left py-3 px-4">{{$folio_tarjeta}}</td>
                        </tr>
                        <tr>
                            <td class="w-1/3 text-left py-3 px-4">Apellido Paterno</td>
                            <td class="w-1/3 text-left py-3 px-4">{{$apellido_paterno}}</td>
                        </tr>
                        <tr class="bg-gray-100">
                            <td class="w-1/3 text-left py-3 px-4">Apellido Materno</td>
                            <td class="w-1/3 text-left py-3 px-4">{{$apellido_materno}}</td>
                        </tr>
                        <tr>
                            <td class="w-1/3 text-left py-3 px-4">Nombre</td>
                            <td class="w-1/3 text-left py-3 px-4">{{$nombre_colaborador}}</td>
                        </tr>
                        <tr class="bg-gray-100">
                            <td class="w-1/3 text-left py-3 px-4">Fecha de Nacimiento</td>
                            <td class="w-1/3 text-left py-3 px-4">{{ Carbon\Carbon::parse($fecha_nacimiento)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td class="w-1/3 text-left py-3 px-4">Sexo</td>
                            <td class="w-1/3 text-left py-3 px-4">{{$sexo}}</td>
                        </tr>
                        <tr class="bg-gray-100">
                            <td class="w-1/3 text-left py-3 px-4">Estado Civil</td>
                            <td class="w-1/3 text-left py-3 px-4">{{$estado_civil}}</td>
                        </tr>
                        <tr>
                            <td class="w-1/3 text-left py-3 px-4">Correo Electrónico</td>
                            <td class="w-1/3 text-left py-3 px-4">{{$correo_electronico_colaborador}}</td>
                        </tr>
                        <tr class="bg-gray-100">
                            <td class="w-1/3 text-left py-3 px-4">Teléfono</td>
                            <td class="w-1/3 text-left py-3 px-4">{{$telefono_colaborador}}</td>
                        </tr>
                        <tr>
                            <td class="w-1/3 text-left py-3 px-4">Estatus</td>
                            <td class="w-1/3 text-left py-3 px-4">{{$status_colaborador}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Document</title>
        <style>
            *{
                box-sizing: border-box;
                font-family: Verdana, Geneva, Tahoma, sans-serif;
                margin: 0;
                padding: 0;
            }
            .divide-y > *{
                border-bottom: solid 1px rgb(229, 231, 235);
            }
            .table{
                border-collapse: collapse;
            }
            .th{
                border-bottom: solid 1px rgb(229, 231, 235);
                font-size: 0.75rem;
                font-weight: 500;
                padding: 0 1rem 0.5rem;
                text-align: left;
                text-transform: uppercase;
            }
            .td{
                padding: 1rem 1rem;
            }
            .text-gray-900{
                color: rgba(17, 24, 39, 1);
            }
            .w-100 {
                width: 100%;
            }
        </style>
    </head>
    <body>
        <div style="padding-top:20px;">
            <header>
                <table class="w-100">
                    <tbody class="w-100">
                        <tr class="w-100">
                            <td style="padding-left:25px; width:30%">
                                Reporte Colaborador por {{$tipo_reporte}}: {{$data}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </header>
            <main style="padding-top:50px;">
                <section style="padding:0 10px;">
                    <table class="w-100 table">
                        <thead class="w-100">
                            <tr class="w-100">
                                <th scope="col" class="th">
                                    Apellido Paterno Colaborador
                                </th>
                                <th scope="col" class="th">
                                    Apellido Materno Colaborador
                                </th>
                                <th scope="col" class="th">
                                    Nombre Colaborador
                                </th>
                                <th scope="col" class="th">
                                    Fecha Ingreso
                                </th>
                                <th scope="col" class="th">
                                    Hora Ingreso
                                </th>
                                <th scope="col" class="th">
                                    Fecha Egreso
                                </th>
                                <th scope="col" class="th">
                                    Hora Egreso
                                </th>
                                <th scope="col" class="th">
                                    Diagnóstico
                                </th>
                                <th scope="col" class="th">
                                    Doctor atendido
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-900">
                            @foreach($ingresos as $ingreso)
                                <tr class="">
                                    <td class="td">
                                        <div>
                                            {{ $ingreso->paciente->colaborador->apellido_paterno }}
                                        </div>
                                    </td>
                                    <td class="td">
                                        <div>
                                            {{ $ingreso->paciente->colaborador->apellido_materno }}
                                        </div>
                                    </td>
                                    <td class="td">
                                        <div>
                                            {{ $ingreso->paciente->colaborador->nombre }}
                                        </div>
                                    </td>
                                    <td class="td" style="white-space:nowrap;">
                                        <div>
                                            {{ Carbon\Carbon::parse($ingreso->Date_In)->format('d-m-Y') }}
                                        </div>
                                    </td>
                                    <td class="td">
                                        <div>
                                            {{ Carbon\Carbon::parse($ingreso->Hour_In)->format('H:i:s') }}
                                        </div>
                                    </td>
                                    <td class="td" style="white-space:nowrap;">
                                        <div>
                                            @if($ingreso->Date_Out != null)
                                                {{ Carbon\Carbon::parse($ingreso->Date_Out)->format('d-m-Y') }}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="td">
                                        <div>
                                            @if($ingreso->Hour_Out != null)
                                                {{ Carbon\Carbon::parse($ingreso->Hour_Out)->format('H:i:s') }}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="td">
                                        <div>
                                            {{ $ingreso->Diag_Desc }}
                                        </div>
                                    </td>
                                    <td class="td">
                                        <div>
                                            {{ $ingreso->medico_atendido() }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </main>
        </div>
    </body>
</html>
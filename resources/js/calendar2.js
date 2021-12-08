import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from '@fullcalendar/list';
import esLocale from '@fullcalendar/core/locales/es';

window.axios = require('axios');

axios.defaults.headers.common = {
    'X-CSRF-TOKEN': document.getElementById('formulario2')._token.value,
    'X-Requested-With' : 'XMLHttpRequest'
};

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('agenda');
    
    var formulario = document.getElementById('formulario'); // Formulario para creación
    var formulario2 = document.getElementById('formulario2'); // Formulario para edición y borrado

    var calendar = new Calendar(calendarEl, {
        plugins: [ dayGridPlugin,timeGridPlugin, listPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        locale: esLocale,
        slotDuration: '00:15',
        eventSources:{
            url: baseURL + '/citas/' + sucursal,
            method: 'POST',
            extraParams:{
                _token: formulario._token.value,
            },
            allDay: false,
        },
        headerToolbar:{
            left:'prev,next today',
            center:'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        dateClick:function(info){
            formulario.reset();
            document.getElementById('evento').classList.toggle("hidden");

            let mes = info.date.getMonth()+1 < 10 ? '0'+(info.date.getMonth()+1) : info.date.getMonth()+1,
                dia = info.date.getDate() < 10 ? '0'+(info.date.getDate()) : info.date.getDate();
            let fecha = info.date.getFullYear() + '-' + mes + '-' + dia,
                hora = info.date.getHours() < 10 ? '0'+info.date.getHours() : info.date.getHours(),
                minutos = info.date.getMinutes() < 10 ? '0'+info.date.getMinutes() : info.date.getMinutes(),
                horario = hora + ':' + minutos;

            formulario.start.value = fecha;
            formulario.end.value = fecha;
            formulario.hora_inicio.value = horario;
        },
        eventClick:function(info){

          axios.post(baseURL + '/evento/editar/'+info.event.id)
            .then((respuesta)=>{
                let start = respuesta.data.start,
                        end = respuesta.data.end;
                start = start.split(' ');
                end = end.split(' ');

                formulario2.id.value = respuesta.data.id;
                formulario2.apellido.value = respuesta.data.apellido;
                formulario2.nombre.value = respuesta.data.nombre;
                formulario2.start.value = start[0];
                formulario2.hora_inicio.value = start[1];
                formulario2.hora_fin.value = end[1];
                formulario2.end.value = end[0];
                document.getElementById('edit').classList.toggle("hidden");
            })
            .catch((error)=>{
                if (error.response) {
                    console.log(error.response.data);
                }
            }) 
        }
    });

    calendar.render();

    // CREAR NUEVO EVENTO
    document.getElementById('btnGuardar').addEventListener('click',function(e){
        e.preventDefault();
        const datos = new FormData(formulario);
        
        axios.post(baseURL + '/evento/agregar',datos)
        .then((respuesta)=>{
            document.getElementById('evento').classList.toggle("hidden");
        })
        .catch((error)=>{
            if (error.response) {
                console.log(error.response.data);
                //document.getElementById('error').classList.toggle('hidden');
            }
        })
    })

    // BORRAR EVENTO
    document.getElementById('btnEliminar').addEventListener('click',function(e){
        e.preventDefault();
        axios.post(baseURL + '/evento/eliminar/'+formulario2.id.value)
        .then((respuesta)=>{
            document.getElementById('edit').classList.toggle("hidden");
        })
        .catch((error)=>{
            if (error.response) {
                console.log(error.response.data);
                //document.getElementById('error').classList.toggle('hidden');
            }
        })
    })

    // EDITAR EVENTO 
    document.getElementById('btnEditar').addEventListener('click',function(e){
        e.preventDefault();
        const datos = new FormData(formulario2);

        axios.post(baseURL + '/evento/actualizar/'+formulario2.id.value,datos)
        .then((respuesta)=>{
            document.getElementById('edit').classList.toggle("hidden");
        })
        .catch((error)=>{
            if (error.response) {
                console.log(error.response.data);
                //document.getElementById('error').classList.toggle('hidden');
            }
        })
    })
});
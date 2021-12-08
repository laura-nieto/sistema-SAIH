import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('citasHoy');
    
    var token = document.getElementById('tokenCalendario'); // Obtener token

    var calendar = new Calendar(calendarEl, {
        plugins: [ dayGridPlugin,timeGridPlugin	],
        height: 600,
        initialView: 'timeGridDay',
        locale:'es',
        slotDuration: '00:15',
        eventSources:{
            url: baseURL + '/citas/' + sucursal,
            method: 'POST',
            extraParams:{
                _token: token.value,
            },
            allDay: false,
        },
        headerToolbar:{
            left:'prev today',
            center:'title',
            right: 'next'
        },
        footerToolbar: {
            left: '',
            center: '',
            right: 'custom1'
        },
        customButtons: {
            custom1: {
                text: 'Ver citas',
                click: function() {
                    window.location.href = baseURL + '/citas/mostrar';
                }
            },
        }
    })
    calendar.render();
});

const BASE_URL = "http://localhost/eventosDgire/";

document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        hiddenDays: [0],
        height: 550,
        locale: 'es',
        headerToolbar: {
            right: 'dayGridMonth timeGridWeek timeGridDay listWeek'
        },
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        },
        slotMinTime: '08:00:00',
        slotMaxTime: '20:00:01',
        allDaySlot: false,
        displayEventEnd: true,

        events: 'listar',

        eventDataTransform: function (event) {
            event.title = event.titulo;
            event.startRecur = event.inicio;
            event.endRecur = event.fin;
            event.startTime = event.inicio.split(' ')[1];
            event.endTime = event.fin.split(' ')[1];

            return event;
        },
        dateClick: function(info) {
            info.date = new Date(info.date).toISOString().slice(0, 10);
            $('#eventModal').modal('show');
            $('#fcInicio, #fcFin').attr('value',  info.date);
          },
        
        select: function (selectInfo) {
            //Código de prueba 
           
            //
            var today = new Date(); //OBTENER LA FECHA ACTUAL Y LANZAR ERROR DE FECHAS PASADAS
            today = new Date(today.getTime() - (today.getTimezoneOffset() * 60000)).toISOString().slice(0, 10);  
            selectInfo.start = new Date(selectInfo.start).toISOString().slice(0, 10);
            selectInfo.end = new Date(selectInfo.end - 60 * 60 * 24 * 1000).toISOString().slice(0, 10); //RESTAR UN DÍA A LA FECHA FIN QUE ARROJA FULLCALENDAR 

            if (selectInfo.start >= today) {
                $('#eventModal').modal('show');
                $('#fcInicio').attr('value', selectInfo.start);
                $('#fcFin').attr('value', selectInfo.end);
            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No es posible agendar un evento en fechas pasadas',
                })
            }
        },
    });

    calendar.render();

    $(document).ready(function formValidate() {
        jQuery.validator.addMethod("time", function (value, element) {
            var res = false;
            res = this.optional(element) || /^\d{2}[:]\d{2}$/.test(value);

            var hora = value.split(':');
            var hh = parseInt(hora[0], 10);
            var mm = parseInt(hora[1], 10);
            if (hh < 0 || hh > 23) res = false;
            if (mm < 0 || mm > 59) res = false;

            return res;
        }, "Ingrese un formato de hora correcto"
        );

        $('#formEvent').validate({
            rules: {
                titulo: {
                    required: true, maxlength: 60
                },

                hrInicio: {
                    required: true,
                    time: true
                },

                hrFin: {
                    required: true,
                    time: true
                },

                color: {
                    required: true,

                },
            },

            messages: {
                titulo: {
                    required: "Ingrese un título", maxlength: "Ingrese menos de 60",
                },

                hrInicio: {
                    required: "Ingrese hora de inicio",
                },

                hrFin: {
                    required: "Ingrese hora de fin",
                },

                color: {
                    required: "Seleccione un color",
                },
            },

            errorPlacement:
                function (error, element) {
                    if (element.is(":radio")) {
                        error.appendTo('#groupColor');
                    }
                    else {
                        error.insertAfter(element);
                    }
                },

            submitHandler: function () {

                var titulo = $('#titulo').val();
                var fcInicio = $('#fcInicio').val() + ' ' + $('#hrInicio').val();
                var fcFin = $('#fcFin').val() + ' ' + $('#hrFin').val();
                var color = $('input:radio[name=color]:checked').val();
                var aula = $('#aula').val();

                $.ajax({
                    url: BASE_URL + 'evento/guardar',
                    type: 'POST',
                    data: {
                        titulo: titulo,
                        inicio: fcInicio,
                        fin: fcFin,
                        color: color,
                        idAula: aula
                    },

                    success: function () {

                        $('#eventModal').modal('hide');
                        $('#formEvent').trigger('reset');
                        calendar.refetchEvents();

                        Swal.fire(
                            'Guardado!',
                            'El evento fue creado con éxito',
                            'success'
                        )
                    },

                    error: function () {

                        Swal.fire(
                            'Error!',
                            'No fue posible crear el evento',
                            'error'
                        )
                        $('.timepicker').timepicker({
                            timeFormat: 'HH:mm',
                            interval: 60,
                            minTime: '8:00',
                            maxTime: '20:00',
                            dynamic: false,
                            scrollbar: true
                        });
                    }
                })
            }
        })
    });
});

$(document).ready(function () {
    $('.timepicker').timepicker({
        timeFormat: 'HH:mm',
        interval: 60,
        minTime: '8:00',
        maxTime: '20:00',
        dynamic: false,
        scrollbar: true
    });
})
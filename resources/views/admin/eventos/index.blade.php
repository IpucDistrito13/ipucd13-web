@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Eventos</h1>
@stop

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- /.col -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stop

@section('js')

    <!-- Bootstrap -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jQuery UI -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/main.js') }}"></script>

    <script>
        $(function() {

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            // initialize the external events
            // -----------------------------------------------------------------

            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                //slotMinTime: '12:30',

                /// Idioma español
                locale: 'es', // Esta línea establece el idioma en español

                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día',
                    list: 'Agenda',
                },

                weekText: 'Sm',
                weekTextLong: 'Semana',
                allDayText: 'Todo el día',
                moreLinkText: 'más',
                moreLinkHint(eventCnt) {
                    return `Mostrar ${eventCnt} eventos más`;
                },

                noEventsText: 'No hay eventos para mostrar',
                navLinkHint: 'Ir al $0',
                closeHint: 'Cerrar',
                timeHint: 'La hora',
                eventHint: 'Evento',

                eventClick: function(info) {
                    info.jsEvent.preventDefault();

                    // Cambiar el color del borde
                    info.el.style.borderColor = 'red';

                    // Verificar si el lugar no es nulo antes de mostrarlo
                    var lugar = info.event.extendedProps.lugar;
                    var start = info.event.start;
                    var end = info.event.end;

                    // Obtener el ID del evento
                    console.log('Identificador: ' + info.event)
                    var eventId = info.event.id;

                    // Crear la cadena HTML para mostrar el lugar, la fecha de inicio y la fecha final
                    var eventDetailsHTML = '<p>';

                    if (start && end) {
                        eventDetailsHTML += 'Fecha de inicio: ' + start.toLocaleString() + '<br>';
                        eventDetailsHTML += 'Fecha final: ' + end.toLocaleString() + '<br>';
                    }

                    if (lugar) {
                        eventDetailsHTML += 'Lugar: ' + lugar + '<br>';
                    }
                    eventDetailsHTML += '</p>';

                    Swal.fire({
                        title: info.event.title,
                        icon: "warning",
                        html: eventDetailsHTML,
                    }).then((result) => {

                    });
                },


                // events will be populated dynamically
                events: function(info, successCallback, failureCallback) {
                    $.ajax({
                        url: "{{ route('public.eventos.apiGetEventos') }}",
                        method: 'GET',
                        success: function(response) {

                            var events = response.map(function(eventData) {
                                return {
                                    id: eventData.id,
                                    title: eventData.title,
                                    start: new Date(eventData.start),
                                    end: new Date(eventData.end),
                                    backgroundColor: eventData.backgroundColor,
                                    borderColor: eventData.borderColor,
                                    allDay: eventData.allDay,
                                    lugar: eventData
                                        .lugar, // Agregar la propiedad 'lugar'

                                };
                            });
                            // Call successCallback with the parsed events
                            successCallback(events);
                        },
                        error: function(xhr, status, error) {
                            // Call failureCallback if there's an error
                            failureCallback(error);
                        }
                    });


                },
                droppable: true,
                drop: function(info) {
                    // Your drop event handler code
                    if (checkbox.checked) {
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                }
            });


            calendar.render();
            // $('#calendar').fullCalendar()

        })
    </script>


@stop
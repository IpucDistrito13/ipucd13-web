@extends('adminlte::page')

@section('title', 'Cronograma distrital | IPUC D13')

@section('content_header')
    <h1>Cronograma distrital</h1>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <!-- registro -->

        <div class="col-md-5">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos cronograma</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('admin.cronogramas.store') }}" autocomplete="off">

                    @csrf
                    <div class="card-body">

                        @include('admin.eventos.form')

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>

            </div>
            <!-- /.card -->


        </div>
        <!--/. registro) -->


        <!-- calendario -->
        <div class="col-md-7">
            <div class="card card-primary">
                <div class="card-body p-0">
                    <!-- THE CALENDAR -->
                    <div id="calendar"></div>
                </div>
                <!-- /.card-body -->
            </div>


        </div>
        <!--/.calendario -->

    </div>
    <!-- /.row -->

@stop

@section('css')
    {{-- Bootstrap 4 --}}
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stop

@section('js')

    
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
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Eliminar esta fecha",
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        // Si el usuario confirma la eliminación
                        if (result.isConfirmed) {
                            // Obtener el token CSRF del meta tag
                            var csrfToken = $('meta[name="csrf-token"]').attr('content');
                            console.log("ID del evento:", eventId);

                            // Realizar la solicitud AJAX para eliminar el evento
                            $.ajax({

                                url: "{{ url('admin/eventos') }}/" + eventId,
                                type: 'DELETE',
                                data: {
                                    "_token": csrfToken
                                },
                                success: function(response) {
                                    // Manejar la respuesta exitosa (p. ej., recargar el calendario)
                                    // Por ejemplo:
                                    calendar.refetchEvents();
                                    Swal.fire('Evento eliminado', '', 'success');
                                },
                                error: function(xhr, status, error) {
                                    // Manejar el error (p. ej., mostrar un mensaje de error)
                                    Swal.fire('Error al eliminar el evento', '',
                                        'error');
                                }
                            });
                        }
                    });
                },


                // events will be populated dynamically
                events: function(info, successCallback, failureCallback) {
                    $.ajax({
                        url: "{{ route('public.cronogramas.apiGetCronogramas') }}",
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

        })
    </script>


@stop

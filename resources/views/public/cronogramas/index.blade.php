<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>{{ $metaData['title'] }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="{{ $metaData['author']}}">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="description" content="{{ $metaData['description']}}">
    <meta name="robots" content="noindex">

    {{-- <meta name="robots" content="noindex"> --}}
   <!-- favicon icon -->
   @include('public.layouts.iconos')
   <link rel="stylesheet" href="{{ asset('demos/elearning/elearning.css')}}" />


    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body data-mobile-nav-trigger-alignment="right" data-mobile-nav-style="modern" data-mobile-nav-bg-color="#313e3b">

    @include('public.layouts.menu')

    <!-- start section -->
    <section class="position-relative overflow-hidden">
        <div class="container position-relative">

            <div class="row">
                <div id="calendar"></div>

            </div>
            <div class="position-absolute bottom-130px z-index-minus-1 w-100 left-0px d-none d-lg-block">
                <div class="row position-relative mt-50px">
                    <div class="col-12">
                        <!-- start marquees -->
                        <div class="marquees-text fs-200 ls-minus-2px alt-font fw-600 text-nowrap opacity-3">Cronograma
                            distrital</div>
                        <!-- end marquees -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->


    <!-- start footer -->
    @include('public.layouts.footer')
    <!-- end footer -->

    <!-- end footer -->
    <!-- start scroll progress -->
    <div class="scroll-progress d-none d-xxl-block">
        <a href="#" class="scroll-top" aria-label="scroll">
            <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
        </a>
    </div>
    <!-- end scroll progress -->
    <!-- javascript libraries -->
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/vendors.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
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



</body>

</html>

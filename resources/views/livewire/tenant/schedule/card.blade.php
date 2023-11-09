<div>
    <x-card>
        <div id='calendar-container' wire:ignore>
            <div id='calendar'></div>

            <div style='clear:both'></div>
        </div>
    </x-card>
</div>

@push('scripts')
{{--{--    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>--}}

{{--    <script>--}}
{{--        document.addEventListener('livewire:load', function() {--}}
{{--            var Calendar = FullCalendar.Calendar;--}}
{{--            var Draggable = FullCalendar.Draggable;--}}
{{--            var calendarEl = document.getElementById('calendar');--}}
{{--            var checkbox = document.getElementById('drop-remove');--}}
{{--            var data =   @this.events;--}}

{{--            var calendar = new Calendar(calendarEl, {--}}
{{--                editable: true,--}}
{{--                selectable: true,--}}
{{--                selectHelper: false,--}}
{{--                eventLimit: false,--}}
{{--                displayEventTime: false,--}}
{{--                locale: 'pt-br',--}}

{{--                headerToolbar: {--}}
{{--                    start: 'dayGridMonth,timeGridWeek,timeGridDay',--}}
{{--                    center: 'title',--}}
{{--                    end: 'prevYear,prev,next,nextYear'--}}
{{--                },--}}


{{--                events: JSON.parse(data),--}}
{{--                eventColor: '#378006',--}}

{{--                // dateClick(info)  {--}}
{{--                //     var title = prompt('Enter Event Title');--}}
{{--                //     var date = new Date(info.dateStr + 'T00:00:00');--}}
{{--                //     if(title != null && title != ''){--}}
{{--                //         calendar.addEvent({--}}
{{--                //             title: title,--}}
{{--                //             start: date,--}}
{{--                //             allDay: true--}}
{{--                //         });--}}
{{--                //         var eventAdd = {title: title,start: date};--}}
{{--                //     @this.addevent(eventAdd);--}}
{{--                //         alert('Great. Now, update your database...');--}}
{{--                //     }else{--}}
{{--                //         alert('Event Title Is Required');--}}
{{--                //     }--}}
{{--                // },--}}

{{--                drop: function(info) {--}}
{{--                    // is the "remove after drop" checkbox checked?--}}
{{--                    if (checkbox.checked) {--}}
{{--                        // if so, remove the element from the "Draggable Events" list--}}
{{--                        info.draggedEl.parentNode.removeChild(info.draggedEl);--}}
{{--                    }--}}
{{--                },--}}
{{--                eventDrop: info => @this.eventDrop(info.event, info.oldEvent),--}}
{{--                loading: function(isLoading) {--}}
{{--                    if (!isLoading) {--}}
{{--                        // Reset custom events--}}
{{--                        this.getEvents().forEach(function(e){--}}
{{--                            if (e.source === null) {--}}
{{--                                e.remove();--}}
{{--                            }--}}
{{--                        });--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--            calendar.render();--}}
{{--        @this.on(`refreshCalendar`, () => {--}}
{{--            calendar.refetchEvents()--}}
{{--         });--}}
{{--        });--}}
{{--    </script>--}}
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="{{ url('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{ url('vendor/moment/moment.js') }}"></script>

<script src="{{ url('vendor/fullcalendar/js/fullcalendar.min.js') }}"></script>

{{--<script src="{{asset('vendor/pages/calendar-init.js')}}"></script>--}}

    <script type="text/javascript">
        /*
 Template Name: Agroxa - Bootstrap 4 Admin Dashboard
 Author: Themesbrand
 File: Calendar Init
 */


        $(document).ready(function() {
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            /*  className colors

             className: default(transparent), important(red), chill(pink), success(green), info(blue)

             */


            /* initialize the external events
             -----------------------------------------------------------------*/

            $('#external-events div.external-event').each(function() {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });


            /* initialize the calendar
             -----------------------------------------------------------------*/

            var calendar =  $('#calendar').fullCalendar({
                header: {
                    left: 'title',
                    center: 'agendaDay,agendaWeek,month',
                    right: 'prev,next today'
                },
                editable: true,
                firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
                selectable: true,
                defaultView: 'month',

                axisFormat: 'h:mm',
                columnFormat: {
                    month: 'ddd',    // Mon
                    week: 'ddd d', // Mon 7
                    day: 'dddd M/d',  // Monday 9/7
                    agendaDay: 'dddd d'
                },
                titleFormat: {
                    month: 'MMMM YYYY', // September 2009
                    week: "MMMM YYYY", // September 2009
                    day: 'MMMM YYYY'                  // Tuesday, Sep 8, 2009
                },
                allDaySlot: false,
                selectHelper: true,
                select: function(start, end, allDay) {
                    var title = prompt('Event Title:');
                    if (title) {
                        calendar.fullCalendar('renderEvent',
                            {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay
                            },
                            true // make the event "stick"
                        );
                    }
                    calendar.fullCalendar('unselect');
                },
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function(date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }

                },

                events: [
                    {
                        title: 'All Day Event',
                        start: new Date(y, m, 1)
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: new Date(y, m, d-5, 18, 0),
                        allDay: false,
                        className: 'bg-teal'
                    },
                    {
                        id: 999,
                        title: 'Meeting',
                        start: new Date(y, m, d-3, 16, 0),
                        allDay: false,
                        className: 'bg-purple'
                    },
                    {
                        id: 999,
                        title: 'Meeting',
                        start: new Date(y, m, d+4, 16, 0),
                        allDay: false,
                        className: 'bg-warning'
                    },
                    {
                        title: 'Meeting',
                        start: new Date(y, m, d, 10, 30),
                        allDay: false,
                        className: 'bg-danger'
                    },
                    {
                        title: 'Lunch',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 14, 0),
                        allDay: false,
                        className: 'bg-success'
                    },
                    {
                        title: 'Birthday Party',
                        start: new Date(y, m, d+1, 19, 0),
                        end: new Date(y, m, d+1, 22, 30),
                        allDay: false,
                        className: 'bg-brown'
                    },
                    {
                        title: 'Click for Google',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        url: 'http://google.com/',
                        className: 'bg-pink'
                    },
                ],
            });


        });
    </script>

@endpush

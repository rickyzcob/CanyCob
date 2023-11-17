<div>
    <x-card>
        <div wire:ignore>
            <div class="w-full" id='calendar'></div>
            <div style='clear:both'></div>
        </div>
    </x-card>
</div>

@push('scripts')

    <link href="{{ asset('css/teste.css') }}" rel="stylesheet" type="text/css">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>

    <script type="text/javascript">

        document.addEventListener('livewire:load', function() {
            var Calendar = FullCalendar.Calendar;
            var calendarEl = document.getElementById('calendar');
            var data =  {{ Js::from($response->schedule) }};
            // var data =   @this.events;
            // console.log(data)

            var calendar = new Calendar(calendarEl, {
                editable: false,
                selectable: true,
                allDaySlot: false,
                displayEventTime: false,
                locale: 'pt-br',

                headerToolbar: {
                    start: 'dayGridMonth,timeGridWeek,timeGridDay',
                    center: 'title',
                    end: 'prevYear,prev,next,nextYear',
                },

                buttonText:{
                    today:    'Hoje',
                    month:    'Mês',
                    week:     'Semana',
                    day:      'Dia',
                    list:     'Lista',
                },


                // events: data,
                events: JSON.parse(data),



                // eventColor: '#000000',
                // events: [
                //     {
                //         title:'ODC - BRAGANÇA PAULISTA',
                //         start: '2023-11-24',
                //         // overlap: false,
                //         // rendering: 'background',
                //         color: '#257e4a'
                //     },
                //     {
                //         title:'ODC - ATIBAIA',
                //         start: '2023-11-06',
                //         // overlap: false,
                //         // rendering: 'background',
                //         color: "#1d4ed8"
                //     }],

                eventClick: function(data) {
                    Livewire.emitTo('components.open-modal', 'showModal', 'tenant.fees.form', {'id' : data.event.id})
                },

            });

            calendar.render();
        });





                // dateClick(info)  {
                //     var title = prompt('Enter Event Title');
                //     var date = new Date(info.dateStr + 'T00:00:00');
                //     if(title != null && title != ''){
                //         calendar.addEvent({
                //             title: title,
                //             start: date,
                //             allDay: true
                //         });
                //         var eventAdd = {title: title,start: date};
                //     @this.addevent(eventAdd);
                //         alert('Great. Now, update your database...');
                //     }else{
                //         alert('Event Title Is Required');
                //     }
                // },

        //         drop: function(info) {
        //             // is the "remove after drop" checkbox checked?
        //             if (checkbox.checked) {
        //                 // if so, remove the element from the "Draggable Events" list
        //                 info.draggedEl.parentNode.removeChild(info.draggedEl);
        //             }
        //         },
        //         eventDrop: info => @this.eventDrop(info.event, info.oldEvent),
        //         loading: function(isLoading) {
        //             if (!isLoading) {
        //                 // Reset custom events
        //                 this.getEvents().forEach(function(e){
        //                     if (e.source === null) {
        //                         e.remove();
        //                     }
        //                 });
        //             }
        //         }
        //     });
        //     calendar.render();
        // @this.on(`refreshCalendar`, () => {
        //     calendar.refetchEvents()
        //  });
        // });
    </script>
@endpush

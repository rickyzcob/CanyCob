<div>
    <x-card>
        <div  wire:ignore>
            <div id='calendar'></div>
        </div>
    </x-card>
</div>
{{--@dd($events)--}}
@push('scripts')

    <link href="{{ asset('css/fullcalendar.css') }}" rel="stylesheet" type="text/css">
{{--    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>--}}
{{--    <link href='https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.2/main.min.css' rel='stylesheet' />--}}

{{--    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>--}}



<link href='https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.2/main.min.css' rel='stylesheet' />
<link href='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.4.2/main.min.css' rel='stylesheet' />
<link href='https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@4.4.2/main.min.css' rel='stylesheet' />



<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.2/main.min.js'></script>


<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.4.2/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.4.2/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@4.4.2/main.min.js'></script>

{{--    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>--}}

<script type="text/javascript">

    document.addEventListener('livewire:load', function() {

        var schedule =  {{ Js::from($response->schedule) }};
        var data = JSON.parse(schedule);

        var Calendar = FullCalendar.Calendar;
        var calendarEl = document.getElementById('calendar');

        var data_array = JSON.stringify(data)

        var calendar = new Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid', 'timeGrid'],
            timeZone: 'UTC',
            locale: 'pt-br',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'Hoje',
                month: 'Mês',
                week: 'Semana',
                day: 'Dia',
                list: 'Lista',
            },
            editable: false,
            displayEventTime: false,
            allDaySlot: false,
            // eventLimit: true, // when too many events in a day, show the popover

            // events: data,
            events: JSON.parse(data_array),

            eventClick: function successCallback(data) {
                Livewire.emitTo('components.open-modal', 'showModal', 'tenant.schedule.form', {'id': data.event.id})
            },

        });

            calendar.render();

            window.addEventListener('schedule-updated', event => {
                    var data = event.detail.filter;
                    UpdateCalendar(data);
                });

            function UpdateCalendar(data) {
                calendar.removeAllEvents();
                calendar.addEventSource(data);
            }

    });
</script>
@endpush

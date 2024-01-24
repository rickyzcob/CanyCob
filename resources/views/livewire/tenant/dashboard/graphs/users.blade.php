<div>
    <x-card cardClasses="h-96 border-l-4 border-red-700">
        <div class="flex items-start justify-between border-b-2 mb-2">
            <h1 class="text-base text-gray-600 font-semibold py-2">Cobranças por úsuarios</h1>
        </div>
        <div class=" justify-center items-center">
            <div class="ml-2" id="chartUsers"> </div>
        </div>
    </x-card>
</div>


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script type="text/javascript">

        var users =  {{ Js::from($response->charges['users']) }};
        var countPhone = {{ Js::from($response->charges['countPhone']) }};
        var countEmail = {{ Js::from($response->charges['countEmail']) }};
        var countWhatsApp = {{ Js::from($response->charges['countWhatsApp']) }};


        var options = {
            series: [{
                name: 'Telefonemas',
                data: countPhone
            }, {
                name: 'Emails',
                data: countEmail
            }, {
                name: 'Whatsapp',
                data: countWhatsApp
            }],
            chart: {
                toolbar: false,
                type: 'bar',
                height: 250
            },
            toolbar: {
                show: false
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: users,
            },
            yaxis: {
                show: false,
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "$ " + val + " thousands"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chartUsers"), options);
        chart.render();

    </script>
@endpush

<div>
    <x-card cardClasses="h-64 border-l-4 border-red-700">
    <div class=" justify-center items-center">
        <div class="ml-4" id="chargesPhone"> </div>
    </div>
    </x-card>
</div>


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script type="text/javascript">

            var days =  {{ Js::from($response->chargePhones['day']) }};
            var countPhones = {{ Js::from($response->chargePhones['totalPhone']) }};


            var options = {
                series: [
                    {
                        name: "Telefone",
                        data: countPhones
                    }
                    ],
                chart: {
                    toolbar: false,
                    height: 183,
                    type: 'bar',
                    stacked: false,
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#b91c1c', '#dc2626', '#15803d'],

                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: 'smooth'
                },
                // title: {
                //     text: 'Average High & Low Temperature',
                //     align: 'left'
                // },
                grid: {
                    show: false
                },
                markers: {
                    size: 1
                },
                xaxis: {
                    categories: days,
                    // title: {
                    //     text: 'Month'
                    // }
                },
                yaxis: {
                    show: false,
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'center',
                    offsetX: 0,
                    offsetY: 20,
                },

                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function (y) {
                            if (typeof y !== "undefined") {
                                return y.toFixed(0) + "";
                            }
                            return y;

                        }
                    }
                }
            };

            var chartChargesPhone = new ApexCharts(document.querySelector("#chargesPhone"), options);
            chartChargesPhone.render();

        </script>
@endpush

<div>
    <x-card cardClasses="h-64 border-l-4 border-yellow-500">
        <div class=" justify-center items-center">
            <div class="ml-4" id="chargesEmail"> </div>
        </div>
    </x-card>
</div>
@push('scripts')
        <script>

            var days =  {{ Js::from($response->chargeEmail['day']) }};
            var countEmail = {{ Js::from($response->chargeEmail['totalEmail']) }};
            {{--var countEmails = {{ Js::from($response->chargeEmail['totalEmail']) }};/s/--}}
            {{--var countWhatsapp = {{ Js::from($response->chargeEmail['totalWhatsapp']) }};--}}


            var options = {
                series: [
                    {
                        name: "Emails Enviados",
                        data: countEmail
                    }
                    // {
                    //     name: "Whatsapp",
                    //     data: countWhatsapp
                    // }
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
                colors: ['#f59e0b', '#15803d'],

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

            var chartChargesEmail = new ApexCharts(document.querySelector("#chargesEmail"), options);
            chartChargesEmail.render();

        </script>
@endpush

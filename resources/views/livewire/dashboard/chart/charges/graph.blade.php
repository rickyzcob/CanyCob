<div>
    <div class=" justify-center items-center">
        <div class="ml-4" id="charges"> </div>
    </div>
</div>
{{--@dd($response)--}}
@push('body-scripts')
    @once
        <script>

            var days =  {{ Js::from($response->chargeEmail['day']) }};
            var countPhones = {{ Js::from($response->chargeEmail['totalPhone']) }};
            {{--var countEmails = {{ Js::from($response->chargeEmail['totalEmail']) }};--}}
            {{--var countWhatsapp = {{ Js::from($response->chargeEmail['totalWhatsapp']) }};--}}


            var options = {
                series: [
                    {
                        name: "Telefone",
                        data: countPhones
                    }
                    // {
                    //     name: "Emails",
                    //     data: countEmails
                    // },
                    // {
                    //     name: "Whatsapp",
                    //     data: countWhatsapp
                    // }
                ],
                chart: {
                    toolbar: false,
                    height: 200,
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
                colors: ['#075985', '#dc2626', '#15803d'],

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

            var chartCharges = new ApexCharts(document.querySelector("#charges"), options);
            chartCharges.render();

        </script>
    @endonce
@endpush


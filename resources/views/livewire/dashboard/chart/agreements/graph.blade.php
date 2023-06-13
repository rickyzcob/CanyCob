<div>
    <div class=" justify-center items-center">
        <div class="ml-4" id="agreements"> </div>
    </div>
</div>
{{--@push('body-scripts')--}}
{{--    @once--}}
{{--        <script>--}}

{{--            var days =  {{ Js::from($response->chart['day']) }};--}}
{{--            var count = {{ Js::from($response->chart['count']) }};--}}


{{--            var options = {--}}
{{--                series: [--}}
{{--                    {--}}
{{--                        name: "Propostas",--}}
{{--                        data: count--}}
{{--                    },--}}
{{--                    // {--}}
{{--                    //     name: "Low - 2013",--}}
{{--                    //     data: [12, 11, 14, 18, 17, 13, 13]--}}
{{--                    // }--}}
{{--                ],--}}
{{--                chart: {--}}
{{--                    toolbar: false,--}}
{{--                    height: 250,--}}
{{--                    type: 'line',--}}
{{--                    stacked: false,--}}
{{--                    dropShadow: {--}}
{{--                        enabled: true,--}}
{{--                        color: '#000',--}}
{{--                        top: 18,--}}
{{--                        left: 7,--}}
{{--                        blur: 10,--}}
{{--                        opacity: 0.2--}}
{{--                    },--}}
{{--                    toolbar: {--}}
{{--                        show: false--}}
{{--                    }--}}
{{--                },--}}
{{--                colors: ['#77B6EA', '#545454'],--}}

{{--                dataLabels: {--}}
{{--                    enabled: false,--}}
{{--                },--}}
{{--                stroke: {--}}
{{--                    curve: 'smooth'--}}
{{--                },--}}
{{--                // title: {--}}
{{--                //     text: 'Average High & Low Temperature',--}}
{{--                //     align: 'left'--}}
{{--                // },--}}
{{--                grid: {--}}
{{--                    show: false--}}
{{--                },--}}
{{--                markers: {--}}
{{--                    size: 1--}}
{{--                },--}}
{{--                xaxis: {--}}
{{--                    categories: days,--}}
{{--                    // title: {--}}
{{--                    //     text: 'Month'--}}
{{--                    // }--}}
{{--                },--}}
{{--                yaxis: {--}}
{{--                    show: false,--}}
{{--                },--}}
{{--                legend: {--}}
{{--                    show: true,--}}
{{--                    position: 'top',--}}
{{--                    horizontalAlign: 'center',--}}
{{--                    offsetX: 0,--}}
{{--                    offsetY: 20,--}}
{{--                },--}}

{{--                tooltip: {--}}
{{--                    shared: true,--}}
{{--                    intersect: false,--}}
{{--                    y: {--}}
{{--                        formatter: function (y) {--}}
{{--                            if (typeof y !== "undefined") {--}}
{{--                                return y.toFixed(0) + "";--}}
{{--                            }--}}
{{--                            return y;--}}

{{--                        }--}}
{{--                    }--}}
{{--                }--}}
{{--            };--}}

{{--            var chartAgreements= new ApexCharts(document.querySelector("#agreements"), options);--}}
{{--            chartAgreements.render();--}}

{{--        </script>--}}
{{--    @endonce--}}
{{--@endpush--}}


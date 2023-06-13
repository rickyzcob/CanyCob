@extends ('layouts.app')

@section('title', 'DashBoard')

@section('content')

    <div class="page-title-box">
        <div class="container xl justify-center items-center min-h-[640px]">
            <nav class="p-5">
                <ol class="list-reset flex">
                    <li><a href="#" class="text-blue-600 hover:text-blue-700">Home</a></li>
                    <li><span class="text-gray-500 mx-2">/</span></li>
                    <li class="text-gray-100">Dashboard</li>
                </ol>
            </nav>
            <div class="grid grid-cols-1 md:grid-cols-12 w-full gap-3 relative gap-5 px-5">
                @livewire('dashboard.panel.card')
                <div class="md:col-span-10">
{{--                    <div class="pb-5">--}}

{{--                    </div>--}}
                    <div class="md:flex gap-5">
                        <div class="pb-5 md:w-1/2 w-full">
                            @livewire('dashboard.charges.card')
                        </div>
                        <div class="pb-5 md:w-1/2 w-full">
                            @livewire('dashboard.chart.card')
                        </div>
                    </div>


                    <div class="md:flex gap-5">
                        <div class="pb-5 md:w-1/2 w-full">
                            @livewire('dashboard.charges.card')
                        </div>
                        <div class="pb-5 md:w-1/2 w-full">
                        @livewire('dashboard.agreements.card')
                        </div>
                    </div>

                </div>
                <div class="md:col-span-2">
                    @livewire('dashboard.ranking.card')
                </div>

                <div class="md:col-span-10">

                </div>


                <div class="md:col-span-12">
                    @livewire('dashboard.charges.card')
                </div>
            </div>
        </div>
        @livewire('components.central-modal', ['showCentralModal' => $coinsReturnDB, 'component' => 'dashboard.humor.card',  'title' => '', 'message' => '', 'function' => 'addHumor', 'modelid' => null])    </section>
@stop






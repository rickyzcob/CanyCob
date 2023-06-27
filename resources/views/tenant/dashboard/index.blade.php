@extends ('layouts.app')

@section('title', 'DashBoard')

@section('content')

    <div class="page-title-box">
        <div class="container xl justify-center items-center min-h-[640px]">
            <nav class="p-5">
                <ol class="list-reset flex">
                    <span class="material-icons text-base self-center mb-0">bar_chart</span>
                    <li class="text-gray-100">Dashboard</li>
                </ol>
            </nav>
            <div class="grid grid-cols-1 md:grid-cols-12 w-full gap-3 relative gap-5 px-5">
                @livewire('tenant.dashboard.panel.card')
                <div class="md:col-span-10">
                    <div class="md:flex gap-5">
                        <div class="pb-5 md:w-1/2 w-full">
                            @livewire('tenant.dashboard.agreements.card')
                        </div>
                        <div class="pb-5 md:w-1/2 w-full">
{{--                            @livewire('tenant.dashboard.chart.card')/--}}
                        </div>
                    </div>
                    <div class="md:flex gap-5">
                        <div class="pb-5 w-full">
                            @livewire('tenant.dashboard.charges.card')
                        </div>
                    </div>

                </div>
                <div class="md:col-span-2">
                    @livewire('tenant.dashboard.ranking.card')
                </div>
           </div>
        </div>
        @livewire('components.central-modal', ['showCentralModal' => $coinsReturnDB, 'component' => 'tenant.dashboard.humor.card',  'title' => '', 'message' => '', 'function' => 'addHumor', 'params' => ['id' => null]])    </section>
@stop






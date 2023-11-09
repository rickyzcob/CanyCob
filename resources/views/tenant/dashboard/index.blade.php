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
                <div class="md:col-span-3 justify-center ">
                    @can('tenant_dashboard_view_panel')
                    @livewire('tenant.dashboard.panel.total-charge')
                    @endcan
                </div>

                <div class="md:col-span-3 justify-center ">
                    @can('tenant_dashboard_view_panel')
                    @livewire('tenant.dashboard.panel.total-agreement')
                    @endcan
                </div>
                <div class="md:col-span-3 justify-center ">
                    @can('tenant_dashboard_view_panel')
                    @livewire('tenant.dashboard.panel.total-conference')
                    @endcan
                </div>
                <div class="md:col-span-3 justify-center ">
                    @can('tenant_dashboard_view_panel')
                    @livewire('tenant.dashboard.panel.total-historic-charges')
                    @endcan
                </div>
                <div class="md:col-span-10">
                    <div class="md:flex gap-5">
                        <div class="pb-5 md:w-1/2 w-full">
                            @can('tenant_dashboard_view_agreement')
                            @livewire('tenant.dashboard.agreements.card')
                            @endcan
                        </div>
                        <div class="pb-5 md:w-1/2 w-full">
                            @can('tenant_dashboard_view_graph')
                            @livewire('tenant.dashboard.chart.card')
                            @endcan
                        </div>
                    </div>
                    <div class="md:flex gap-5">
                        <div class="pb-5 w-full">
                            @can('tenant_dashboard_view_panel_charges')
                            @livewire('tenant.dashboard.charges.index')
                            @endcan
                        </div>
                    </div>

                </div>
                <div class="md:col-span-2">
                    @can('tenant_dashboard_view_ranking')
                    @livewire('tenant.dashboard.ranking.card')
                    @endcan
                </div>
           </div>
        </div>
        @if(auth()->user()->type  == "Colaborador")
        @livewire('components.central-modal', ['showCentralModal' => $coinsReturnDB, 'component' => 'tenant.dashboard.humor.card',  'title' => '', 'message' => '', 'function' => 'addHumor', 'params' => ['id' => null]])    </section>
        @endif
@stop






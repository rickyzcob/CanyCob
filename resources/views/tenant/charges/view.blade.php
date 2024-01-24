@extends ('layouts.app')
@section('title', 'Minhas Cobranças | Detalhes')

@section('content')
    <div class="page-title-box">
        <div class="container xl justify-center items-center min-h-[640px]">
            <nav class="p-4">
                <ol class="list-reset flex gap-2">
                    <span class="material-icons text-base ">monetization_on</span>
                    <li><a href="{{route('charges.index', session('tenant')['subdomain'])}}" class="text-whites hover:text-blue-700">Cobrança</a></li>
                    <li><span class="text-white mx-2"> / </span></li>
                    <li class="text-gray-100">Detalhes</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 md:grid-cols-12 justify-center items-start gap-5 px-2">
                @can('tenant_change_status_charges')
                <div class="md:col-span-12">
                    @livewire('tenant.charges.top.card', ['reference' => $reference])
                </div>
                @endcan
                <div class="md:col-span-8">
{{--                    <div class="md:flex gap-5">--}}
{{--                        @can('view_franchising_charges')--}}
{{--                        <div class="pb-5 md:w-1/2">--}}
{{--                            @livewire('tenant.charges.details.franchising.card', ['reference' => $reference])--}}
{{--                        </div>--}}
{{--                        @endcan--}}
                        @can('tenant_view_precification_charges')
                        <div class="pb-5">
                            @livewire('tenant.charges.type-releases.table', ['reference' => $reference])
                        </div>
                        @endcan
{{--                    </div>--}}
                    <div>
                        @livewire('tenant.charges.agreement.table', ['reference' => $reference])
                    </div>
                    @can('tenant_view_releases_charges')
                    <div class="pb-5">
                        @livewire('tenant.charges.releases.table', ['reference' => $reference])
                    </div>
                    @endcan
                </div>

                <div class="md:col-span-4 ">
                    @can('tenant_view_proposal_charges')
                    <div class="pb-5">
                        @livewire('tenant.charges.proposal.table', ['reference' => $reference])
                    </div>
                    @endcan
                    @can('tenant_view_proposal_accept_charges')
                    <div class="pb-5">
                        @livewire('tenant.charges.proposal-accept.card', ['reference' => $reference])
                    </div>
                    @endcan
                    @can('tenant_view_historic_charges')
                    <div class="pb-5">
                        @livewire('tenant.charges.historic.table', ['reference' => $reference])
                    </div>
                    @endcan
                </div>

            </div>
        </div>

@stop

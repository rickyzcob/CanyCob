@extends ('layouts.app')
@section('title', 'Minhas Cobranças | Detalhes')

@section('content')
    <div class="page-title-box">
        <div class="container xl justify-center items-center min-h-[640px]">
            <nav class="p-5">
                <ol class="list-reset flex">
                    <li><a href="{{route('charges.index')}}" class="text-whites hover:text-blue-700">Cobrança</a></li>
                    <li><span class="text-white mx-2"> / </span></li>
                    <li class="text-gray-100">Detalhes</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 md:grid-cols-12 justify-center items-start gap-5">
                @can('change_status_charges')
                <div class="md:col-span-12">
                    @livewire('charges.top.card', ['reference' => $reference])
                </div>
                @endcan
                <div class="md:col-span-8">
                    <div class="flex gap-5">
                        @can('view_franchising_charges')
                        <div class="pb-5 w-1/2">
                            @livewire('charges.details.franchising.card', ['reference' => $reference])
                        </div>
                        @endcan
                        @can('view_precification_charges')
                        <div class="pb-5 w-1/2">
                            @livewire('charges.precificate.card', ['reference' => $reference])
                        </div>
                        @endcan
                    </div>
                    <div>
                        @livewire('charges.agreement.table', ['reference' => $reference])
                    </div>
                    @can('view_releases_charges')
                    <div class="pb-5">
                        @livewire('charges.releases.table', ['reference' => $reference])
                    </div>
                    @endcan
                </div>

                <div class="md:col-span-4 ">
                    @can('view_proposal_charges')
                    <div class="pb-5">
                        @livewire('charges.proposal.table', ['reference' => $reference])
                    </div>
                    @endcan
                    @can('view_proposal_accept_charges')
                    <div class="pb-5">
                        @livewire('charges.proposal-accept.card', ['reference' => $reference])
                    </div>
                    @endcan
                    @can('view_historic_charges')
                    <div class="pb-5">
                        @livewire('charges.historic.table', ['reference' => $reference])
                    </div>
                    @endcan
                </div>

            </div>
        </div>

@stop

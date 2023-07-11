<div>
    @if($charge->total_amount_corrected > auth()->user()->value_agreement)
    <x-card cardClasses="h-42 border-l-4 border-orange-600">
        <div class="flex items-start justify-between border-b-2 mb-2">
            <h1 class="text-base text-gray-600 font-semibold py-2">Termo de Aceite</h1>
            @if($response->proposal == null)
                @can('add_proposal_accept_charges')
                <x-button wire:click="openModal('tenant.charges.proposal-accept.form', {'id': {{$charge->id}} })" orange sm icon="plus-circle" label="Novo" />
                @endcan
            @endif
        </div>

        @if($response->proposal)
            <ul class="max-w-full flex flex-col">
                    <div class="flex items-center justify-between gap-x-2 py-3 px-2 text-sm font-medium odd:bg-gray-100 bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:odd:bg-slate-800 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                        <div>
                            Termo  {{$response->proposal['templateproposal']['type']}} - {{ $response->proposal['id'] }} - {{ $response->proposal['status'] }}
                            <div class="text-sm leading-4 font-normal"><span class="text-xs leading-4 font-normal text-gray-500"> Sócio : {{ ($response->proposal['partner']['name']) }}</span> </div>
                            <div class="text-[8px] leading-4 font-normal"><span class="text-xs leading-4 font-normal text-gray-500"> Data : {{ formatDateAndTime($response->proposal['created_at']) }}</span> </div>
                            <div class="text-[8px] leading-4 font-normal"><span class="text-xs leading-4 font-normal text-gray-500"> Válido por : {{ $response->proposal['days'] }} dias</span> </div>
                            <div class="text-[8px] leading-4 font-normal"><span class="text-xs leading-4 font-normal text-gray-500"> Aceita : {{ $response->proposal['accept'] }} </span> </div>
                        </div>
                        <div>
                            @can('details_proposal_accept_charges')
                            <x-button.circle sm a href="{{route('formalized.show', ['subdomain' => session('tenant')['subdomain'], 'reference' => $response->proposal['reference']])}}" target="_blank" positive icon="eye"  />
                            @endcan
                            @can('send_email_proposal_accept_charges')
                            <x-button.circle wire:click="sentProposalAcceptMail({{ $response->proposal['id'] }})" sm cyan icon="arrow-circle-up" spinner />
                            @endcan
                            @if(['status'] == 'Ativo')
                                @can('block_proposal_accept_charges')
                                <x-button.circle wire:click="changeStatus({{ $response->proposal['id'] }}, 'Inativo')" sm black icon="ban" />
                            @else
                                <x-button.circle sm wire:click="changeStatus({{ $response->proposal['id'] }}, 'Ativo')" teal icon="ban" />
                                    @endcan
                                @endif
{{--                            <x-butto    n.circle wire:click="openModal('tenant.charges.proposal.form', {'id': {{$charge['id']}} })" sm warning icon="pencil-alt" />--}}
                            @can('delete_proposal_accept_charges')
                            <x-button.circle wire:click="openConfirmModal({{ $response->proposal['id'] }}, 'Apagar Registro' , 'Você tem certeza que deseja apagar a seguinte a proposta ?', 'confirmDeleteProposalFormal')" sm negative icon="x-circle" />
                            @endcan
                        </div>
                    </div>
            </ul>
            @endif

    </x-card>
    @endif
</div>



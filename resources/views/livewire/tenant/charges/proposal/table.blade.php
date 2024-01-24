<div>
    <x-card cardClasses="h-80 border-l-4 border-violet-600">
        <div class="flex items-start justify-between border-b-2 mb-2">
            <div class="flex items-center text-base text-violet-600 font-bold gap-x-2">
                <span class="material-icons text-base ">newspaper</span>
                <h1 class="text-base  py-1">Propostas Emitidas</h1>
            </div>
            @if($charge['agreement'] == 0)
                @can('tenant_add_proposal_charges')
                    <x-button wire:click="openModal('tenant.charges.proposal.form', {'id': {{$charge['id']}} })" violet xs icon="plus-circle" label="Nova Proposta" />
                @endcan
            @endif
        </div>

        <div class="scrollbar" id="style-1">
            <ul class="max-w-full flex flex-col">
                @foreach($response->proposals as $itemProposal)
                    <div class="flex items-center justify-between gap-x-2 py-3 px-2 text-sm font-medium odd:bg-gray-100 bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:odd:bg-slate-800 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                        <div>
                            Proposta de {{$itemProposal['templateproposal']['type']}} - {{ $itemProposal['id'] }}
                            <div class="text-sm leading-4 font-normal"><span class="text-xs leading-4 font-normal text-gray-500"> Sócio : {{ ($itemProposal['partner']['name']) }}</span> </div>
                            <div class="text-[8px] leading-4 font-normal"><span class="text-xs leading-4 font-normal text-gray-500"> Data : {{ formatDateAndTime($itemProposal['created_at']) }}</span> </div>
                        </div>
                        <div>

                            @can('tenant_details_proposal_charges')
                            <x-button.circle xs a href="{{route('proposal.show', ['subdomain' => session('tenant')['subdomain'], 'reference' => $itemProposal['reference']])}}" target="_blank" positive icon="eye"  />
                            @endcan

                            @if($charge['agreement'] == 0)
                                @can('tenant_send_email_proposal_charges')
                                <x-button.circle wire:click="sentProposalMail({{ $itemProposal['id'] }})" xs cyan icon="arrow-circle-up" spinner />
                                @endcan
                            @if($itemProposal['status'] == 'Ativo')
                                @can('tenant_block_proposal_charges')
                                <x-button.circle wire:click="changeStatus({{ $itemProposal['id'] }}, 'Inativo')" xs black icon="ban" />
                                @else
                                <x-button.circle xs wire:click="changeStatus({{ $itemProposal['id'] }}, 'Ativo')" teal icon="ban" />
                                @endcan
                            @endif
{{--                            <x-button.circle wire:click="openModal('tenant.charges.proposal.form', {'id': {{$charge['id']}} })" sm warning icon="pencil-alt" />--}}
                                @can('tenant_delete_proposal_charges')
                                <x-button.circle wire:click="openConfirmModal({{ $itemProposal['id'] }}, 'Apagar Registro' , 'Você tem certeza que deseja apagar a seguinte a proposta ?', 'confirmDeleteProposals')" xs negative icon="x-circle" />
                                @endcan
                            @endif
                        </div>
                    </div>
                @endforeach
            </ul>
        </div>
    </x-card>
</div>

<div>
    @if($proposal['accept'] == 'Sim' && $proposal['status'] == 'Ativo')
        <div id="accept">
            Proposta Aceita em {{ formatDateAndTime($proposal['updated_at']) }}
        </div>
    @elseif ($proposal['accept'] == 'Não' && $proposal['status'] == 'Ativo')
        <div class="text-center">
           <x-button green icon="check" spinner wire:click="openCentralModal('tenant.porposal.form', 'Confirmar CPF', 'Para aceitar a proposta acima voce deve inserir seu CPF abaixo', {'id': {{$proposal['id']}} }, 'confirmSubmitCPF')" spinner>Aceitar Proposta </x-button>
        </div>
    @endif
</div>

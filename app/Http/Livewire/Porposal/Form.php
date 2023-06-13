<?php

namespace App\Http\Livewire\Porposal;

use App\Events\ProposalAccept;
use App\Http\Traits\WithModal;
use App\Repositories\ProposalRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Contracts\Redis;

class Form extends Component
{
    use Actions, WithModal;

    public $cpf = '';
    public $proposal_id;

    protected $listeners = ['confirmSubmitCPF' => 'submit'];

    public function mount($id = null)
    {
        if($id){
            $this->proposal_id = $id;
        }
    }

    public function submit($id = null)
    {
        $validatedData = $this->validate([
            'cpf' => 'required|min:11',
        ]);


        $proposalRepository = new ProposalRepository();
        $proposalReturnDB = $proposalRepository->validateCPF($validatedData['cpf'], $id);

        if($proposalReturnDB['status'] == 'success') {
            $this->emitTo('notifications.button','NotificationMarkedAsRead');

            ProposalAccept::dispatch('Proposta Aceita !');

            $this->emit('closeCentralModal');
//            $this->emit('');

//            $this->dialog([
//                'title'       => 'Sucesso !',
//                'description' => $proposalReturnDB['message'],
//                'icon'        => 'success',
//            ]);



        } else if ($proposalReturnDB['status'] == 'error') {
            $this->dialog([
                'title'       => 'Atenção !',
                'description' => $proposalReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeCentralModal');
        }
    }
    public function render()
    {
        return view('livewire.porposal.form');
    }
}

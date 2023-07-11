<?php

namespace App\Http\Livewire\Tenant\ProposalAccept;

use App\Http\Traits\WithModal;
use App\Repositories\ProposalAcceptRepository;
use Livewire\Component;

class ButtonAccept extends Component
{
    use WithModal;

    public $proposal;

    protected $listeners = [
        'refreshButtonAccept' => '$refresh',
    ];
    public function mount($id = null)
    {
        if($id){
            $proposalAcceptRepository = new ProposalAcceptRepository();
            $proposalReturnDB = $proposalAcceptRepository->show($id)['data'];

            $this->proposal = $proposalReturnDB;
        }
    }

    public function render()
    {
        return view('livewire.tenant.proposal-accept.button-accept');
    }
}

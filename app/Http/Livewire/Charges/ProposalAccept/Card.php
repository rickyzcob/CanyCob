<?php

namespace App\Http\Livewire\Charges\ProposalAccept;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesFranchisingRepository;
use App\Repositories\ProposalAcceptRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Card extends Component
{
    use Actions, WithModal;

    public $reference;
    public $proposalAccept;

    protected $listeners = [
        'refreshCardProposalComercial' => '$refresh',
        'confirmDeleteProposalFormal' => 'delete',
    ];

    public function mount($reference = null)
    {
        if ($reference){
            $this->reference = $reference;
        }
    }

    public function delete($id = null)
    {
        $proposalRepository = new ProposalAcceptRepository();
        $proposalReturnDB = $proposalRepository->delete($id, $this->charge_id);

        if($proposalReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Deletar !',
                'description' => $proposalReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeConfirmModal');
            $this->emit('refreshCardPrecification');
            $this->emit('refreshCardProposalComercial');
        } else if ($proposalReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Deletar',
                'description' => $proposalReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeDeleteModal');
        }
    }

    public function changeStatus($id = null, $status)
    {

        $proposalRepository = new ProposalAcceptRepository();
        $proposalReturnDB = $proposalRepository->changeStatus($id, $status);

        if($proposalReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Proposta !',
                'description' => $proposalReturnDB['message'],
                'icon'        => 'success'
            ]);

            $this->emit('refreshTableCategories');
        } else if ($proposalReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Proposta',
                'description' => $proposalReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeDeleteModal');
        }
    }

    public function getPrososalAcceptByCharge()
    {
        $chargeFranchisingRepository = new ChargesFranchisingRepository();
        $chargeFranchisingReturnDB = $chargeFranchisingRepository->showByReference($this->reference)['data'];

        return $chargeFranchisingReturnDB['proposalAccept'];
    }

    public function render()
    {
        $response = new \stdClass();
        $response->proposal = $this->getPrososalAcceptByCharge();

        return view('livewire.charges.proposal-accept.card', ['response' => $response]);
    }
}

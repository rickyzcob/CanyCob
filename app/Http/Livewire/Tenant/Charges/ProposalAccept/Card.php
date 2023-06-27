<?php

namespace App\Http\Livewire\Tenant\Charges\ProposalAccept;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesFranchisingRepository;
use App\Repositories\ConfigurationRepository;
use App\Repositories\ProposalAcceptRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Card extends Component
{
    use Actions, WithModal;

    public $reference;
    public $proposalAccept;
    public $charge;
    public $configuration;

    protected $listeners = [
        'refreshCardProposalComercial' => '$refresh',
        'confirmDeleteProposalFormal' => 'delete',
    ];

    public function mount($reference = null)
    {
        if ($reference){
            $chargeFranchisingRepository = new ChargesFranchisingRepository();
            $chargeFranchisingReturnDB = $chargeFranchisingRepository->showByReference($reference)['data'];
            $this->charge = $chargeFranchisingReturnDB;
        }

        $configurationRepository = new ConfigurationRepository();
        $this->configuration = $configurationRepository->getConfiguration();
    }

    public function delete($id = null)
    {
        $proposalRepository = new ProposalAcceptRepository();
        $proposalReturnDB = $proposalRepository->delete($id, $this->charge->id);

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

        return view('livewire.tenant.charges.proposal-accept.card', ['response' => $response]);
    }
}

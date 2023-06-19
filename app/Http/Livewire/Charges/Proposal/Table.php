<?php

namespace App\Http\Livewire\Charges\Proposal;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesFranchisingRepository;
use App\Repositories\ChargesHistoricsRepository;
use App\Repositories\FranchisingRepository;
use App\Repositories\ProposalRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Table extends Component
{
    use WithModal, Actions;

    protected $listeners = [
        'refreshTableChargeProposals' => '$refresh',
        'confirmDeleteProposals' => 'delete',
    ];

    public $charge;

    public function mount($reference = null, $charge_id = null)
    {

        $chargeFranchisingRepository = new ChargesFranchisingRepository();
        if($reference){
            $chargeFranchisingReturnDB = $chargeFranchisingRepository->showByReference($reference)['data'];
        } elseif ($charge_id){
            $chargeFranchisingReturnDB = $chargeFranchisingRepository->show($charge_id)['data'];
        }

        $this->charge = $chargeFranchisingReturnDB;

    }

    public function delete($id = null)
    {
        $proposalRepository = new ProposalRepository();
        $proposalReturnDB = $proposalRepository->delete($id);

        if($proposalReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Deletar !',
                'description' => $proposalReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeConfirmModal');
            $this->emit('refreshCardPrecification');
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

        $proposalRepository = new ProposalRepository();
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

    public function sentProposalMail($id = null)
    {
        $proposalRepository = new ChargesHistoricsRepository();
        $proposalReturnDB = $proposalRepository->sentProposal($id);

        if($proposalReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Proposta !',
                'description' => $proposalReturnDB['message'],
                'icon'        => 'success'
            ]);

            $this->emit('refreshTableChargeHistoric');
            $this->emit('refreshCardPrecification');
        } else if ($proposalReturnDB['status'] == 'error') {
            $this->dialog([
                'title'       => 'Atenção !',
                'description' => $proposalReturnDB['message'],
                'icon'        => 'error'
            ]);
        }
    }

    public function getProsposalsByCharge()
    {
        $proposalRepository = new ProposalRepository();
        return $proposalRepository->getPrososalsByCharge($this->charge['id']);
    }

    public function render()
    {
        $response = new \stdClass();
        $response->proposals = $this->getProsposalsByCharge();

        return view('livewire.charges.proposal.table', ['response' => $response]);
    }
}

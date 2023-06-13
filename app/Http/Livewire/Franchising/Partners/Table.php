<?php

namespace App\Http\Livewire\Franchising\Partners;

use App\Http\Traits\WithModal;
use App\Repositories\FranchisingRepository;
use App\Repositories\PartnersRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Table extends Component
{
    use WithModal, Actions;

    public $franchising;

    protected $listeners = [
        'refreshTableFranchisingPartners' => '$refresh',
        'confirmDelete' => 'delete',
    ];

    public function mount($id = null)
    {
        $this->franchising_id = $id;
        $franchisingRepository = new FranchisingRepository();
        $franchisingReturnDB = $franchisingRepository->view($id)['data']->toArray();

        $this->franchising = $franchisingReturnDB;
    }

    public function getPartnerFranchising()
    {
        $partnerRepository = new PartnersRepository();
        $partnerReturnDB = $partnerRepository->getPartnersFranchisings($this->franchising_id);

        return $partnerReturnDB;


    }

    public function render()
    {
        $response = new \stdClass();
        $response->partners = $this->getPartnerFranchising();

        return view('livewire.franchising.partners.table', ['response'=> $response]);
    }
}

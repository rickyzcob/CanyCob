<?php

namespace App\Http\Livewire\Tenant\Charges\Precificate;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesFranchisingRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Card extends Component
{
    use WithModal, Actions;

    public $franchising;
    public $charge;

    protected $listeners = [
        'refreshCardPrecification' => '$refresh',
    ];

    public function mount($reference = null)
    {
        if ($reference){
            $chargeFranchisingRepository = new ChargesFranchisingRepository();
            $chargeFranchisingReturnDB = $chargeFranchisingRepository->showByReference($reference)['data'];

            $this->charge = $chargeFranchisingReturnDB;
//            $this->charge_id = $id;
        }
    }

    public function getInformationCharge()
    {
        if($this->charge){
            $chargeFranchisingRepository = new ChargesFranchisingRepository();
            $chargeFranchisingReturnDB = $chargeFranchisingRepository->show($this->charge['id'])['data'];
            return $chargeFranchisingReturnDB;
        }
    }

    public function getLastChargeHistoric()
    {
        if($this->charge){
            $chargeFranchisingRepository = new ChargesFranchisingRepository();
            $chargeFranchisingReturnDB = $chargeFranchisingRepository->getLastChargeHistoric($this->charge['id'])['data'];
            return $chargeFranchisingReturnDB;
        }

    }

    public function render()
    {
        $response = new \stdClass();
        $response->charge = $this->getInformationCharge();
        $response->lastHistoric = $this->getLastChargeHistoric();

        return view('livewire.tenant.charges.precificate.card', ['response' => $response]);
    }
}

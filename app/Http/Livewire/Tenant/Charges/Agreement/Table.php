<?php

namespace App\Http\Livewire\Tenant\Charges\Agreement;

use App\Repositories\ChargesFranchisingRepository;
use Livewire\Component;

class Table extends Component
{
    public $agreement;
    public $charge_id;

    protected $listeners = ['refreshTableAgreement' => '$refresh'];



    public function mount($reference = null)
    {
        if ($reference) {
           $this->reference = $reference;
        }
    }

    public function getAgreementByCharge()
    {
        $chargeFranchisingRepository = new ChargesFranchisingRepository();
        $chargeFranchisingReturnDB = $chargeFranchisingRepository->showByReference($this->reference)['data'];
        return $chargeFranchisingReturnDB['agreementByCharge'];
    }

    public function render()
    {
        $response = new \stdClass();
        $response->agreement = $this->getAgreementByCharge();

        return view('livewire.tenant.charges.agreement.table', ['response' => $response]);
    }
}

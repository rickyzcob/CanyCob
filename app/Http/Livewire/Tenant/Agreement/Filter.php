<?php

namespace App\Http\Livewire\Tenant\Agreement;

use App\Repositories\AgreementRepository;
use Livewire\Component;

class Filter extends Component
{
    public $state = [
        'status_id' => ''
    ];

    public function submit()
    {
        $request = $this->state;
        $this->emit('filterTableChargesFranchising', $request);

    }

    public function clearFilter()
    {
        $this->reset('state');
        $this->emit('filterTableChargesFranchising');
    }

    public function getStatusAgreements()
    {
        $statusChargesRepository = new AgreementRepository();
        return $statusChargesRepository->getSelectStatusCharge();

    }

    public function render()
    {
        $response = new \stdClass();
        $response->statusAgreements = $this->getStatusAgreements();

        return view('livewire.tenant.agreement.filter', ['response' => $response]);
    }
}

<?php

namespace App\Http\Livewire\Charges;

use App\Repositories\ChargeStatusRepository;
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

    public function getStatusCharges()
    {
        $statusChargesRepository = new ChargeStatusRepository();
        return $statusChargesRepository->getSelectStatusCharge();

    }

    public function render()
    {
        $response = new \stdClass();
        $response->statusCharge = $this->getStatusCharges();

        return view('livewire.charges.filter', ['response' => $response]);
    }
}

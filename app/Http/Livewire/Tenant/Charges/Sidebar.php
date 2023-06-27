<?php

namespace App\Http\Livewire\Tenant\Charges;

use App\Repositories\ChargeStatusRepository;
use Livewire\Component;

class Sidebar extends Component
{
    public function getStatusCharges()
    {
        $statusChargesRepository = new ChargeStatusRepository();
        return $statusChargesRepository->getSelectStatusCharge();

    }

    public function render()
    {
        $response = new \stdClass();
        $response->statusCharge = $this->getStatusCharges();

        return view('livewire.tenant.charges.sidebar', ['response' => $response]);
    }
}

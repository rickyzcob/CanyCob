<?php

namespace App\Http\Livewire\Tenant\Dashboard\Charges;

use App\Repositories\ChargesFranchisingRepository;
use Livewire\Component;

class Conference extends Component
{
    public function getChargesbyUser()
    {
        $chargesRepository = new ChargesFranchisingRepository();
        $chargesReturnDB = $chargesRepository->getChargesByConference()['data'];

        return $chargesReturnDB;
    }
    public function render()
    {
        $response = new \stdClass();
        $response->charges = $this->getChargesbyUser();

        return view('livewire.tenant.dashboard.charges.conference',['response' => $response]);
    }
}

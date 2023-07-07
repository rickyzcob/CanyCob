<?php

namespace App\Http\Livewire\Tenant\Dashboard\Charges;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesFranchisingRepository;
use App\Repositories\ConfigurationRepository;
use Livewire\Component;

class Card extends Component
{
    use WithModal;
    public function getChargesbyUser()
    {
        $chargesRepository = new ChargesFranchisingRepository();
        $chargesReturnDB = $chargesRepository->getDontChargesByUser()['data'];
        return $chargesReturnDB;
    }
    public function render()
    {
        $response = new \stdClass();
        $response->charges = $this->getChargesbyUser();

        return view('livewire.tenant.dashboard.charges.card', ['response' => $response]);
    }
}

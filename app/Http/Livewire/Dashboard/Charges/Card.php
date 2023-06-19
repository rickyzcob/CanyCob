<?php

namespace App\Http\Livewire\Dashboard\Charges;

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

    public function getConfiguration()
    {
        $configurationRepository = new ConfigurationRepository();
        return $configurationRepository->getConfiguration();
    }
    public function render()
    {
        $response = new \stdClass();
        $response->charges = $this->getChargesbyUser();
        $response->configuration = $this->getConfiguration();

        return view('livewire.dashboard.charges.card', ['response' => $response]);
    }
}

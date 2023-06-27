<?php

namespace App\Http\Livewire\Tenant\Fees;

use Livewire\Component;

class Index extends Component
{
    public function teste()
    {

    }

    public function render()
    {
        $response = new \stdClass();
        $response->teste = $this->teste();

        return view('livewire.tenant.fees.index', ['response' => $response]);
    }
}

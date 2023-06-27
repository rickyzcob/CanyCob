<?php

namespace App\Http\Livewire\Tenant\Chargestatuses;

use Livewire\Component;

class Filter extends Component
{

    public $state = [
        'status' => ''
    ];

    public function submit()
    {
        $request = $this->state;
        $this->emit('filterTableChargeStatus', $request);

    }

    public function clearFilter()
    {
        $this->reset();
        $this->emit('filterTableChargeStatus', $request = null);
    }

    public function render()
    {
        return view('livewire.tenant.chargestatuses.filter');
    }
}

<?php

namespace App\Http\Livewire\Tenant\Fees;

use Livewire\Component;

class Filter extends Component
{
    public $state = [
        'status' => ''
    ];

    public function submit()
    {
        $request = $this->state;
        $this->emit('filterTableFees', $request);

    }

    public function clearFilter()
    {
        $this->reset();
        $this->emit('filterTableFees', $request = null);
    }

    public function render()
    {
        return view('livewire.tenant.fees.filter');
    }
}

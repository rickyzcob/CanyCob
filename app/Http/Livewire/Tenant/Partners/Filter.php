<?php

namespace App\Http\Livewire\Tenant\Partners;

use Livewire\Component;
use Livewire\WithPagination;

class Filter extends Component
{
    use WithPagination;

    public $state = [
        'status' => ''
    ];

    public function submit()
    {
        $request = $this->state;
        $this->emit('filterTablePartners', $request);

    }

    public function clearFilter()
    {
        $this->reset();
        $this->emit('filterTablePartners', $request = null);
    }


    public function render()
    {
        return view('livewire.tenant.partners.filter');
    }
}

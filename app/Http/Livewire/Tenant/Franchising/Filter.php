<?php

namespace App\Http\Livewire\Tenant\Franchising;

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
        $this->emit('filterTableFranchising', $request);
        $this->resetPage();

    }

    public function clearFilter()
    {
        $this->reset();
        $this->emit('filterTableFranchising', $request = null);
    }

    public function render()
    {
        return view('livewire.tenant.franchising.filter');
    }
}

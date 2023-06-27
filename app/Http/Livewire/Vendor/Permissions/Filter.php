<?php

namespace App\Http\Livewire\Vendor\Permissions;

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
        $this->emit('filterTableRoles', $request);
        $this->resetPage();

    }

    public function clearFilter()
    {
        $this->reset();
        $this->emit('filterTableRoles', $request = null);
    }

    public function render()
    {
        return view('livewire.vendor.permissions.filter');
    }
}

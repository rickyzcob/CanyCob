<?php

namespace App\Http\Livewire\Tenant\Users;

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
        $this->emit('filterTableUsers', $request);
        $this->resetPage();

    }

    public function clearFilter()
    {
        $this->reset();
        $this->emit('filterTableUsers', $request = null);
    }

    public function render()
    {
        return view('livewire.users.filter');
    }
}

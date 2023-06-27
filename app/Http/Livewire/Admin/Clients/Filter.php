<?php

namespace App\Http\Livewire\Admin\Clients;

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
        $this->emit('filterTableClients', $request);
        $this->resetPage();

    }

    public function clearFilter()
    {
        $this->reset();
        $this->emit('filterTableClients', $request = null);
    }

    public function render()
    {
        return view('livewire.admin.clients.filter');
    }
}

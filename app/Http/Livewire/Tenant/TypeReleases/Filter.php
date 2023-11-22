<?php

namespace App\Http\Livewire\Tenant\TypeReleases;

use Livewire\Component;

class Filter extends Component
{
    public $state = [
        'status' => ''
    ];

    public function submit()
    {
        $request = $this->state;
        $this->emit('filterTableTypeReleases', $request);

    }

    public function clearFilter()
    {
        $this->reset();
        $this->emit('filterTableTypeReleases', $request = null);
    }
    public function render()
    {
        return view('livewire.tenant.type-releases.filter');
    }
}

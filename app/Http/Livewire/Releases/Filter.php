<?php

namespace App\Http\Livewire\Releases;

use Livewire\Component;
use Livewire\WithPagination;

class Filter extends Component
{
    use WithPagination;

    public $state = [
        'cnpj' => '',
        'date_start' => '',
        'date_end' => ''
    ];

    public function submit()
    {
        $validatedData = $this->validate([
            'state.name' => 'nullable|sometimes',
            'state.cnpj' => 'nullable|sometimes',
            'state.date_start' => 'required_with:state.date_end|',
            'state.date_end' => 'required_with:state.date_start|after_or_equal:state.date_start',
        ]);

        $this->emit('filterTableReleases', $validatedData['state']);
    }

    public function clearFilter()
    {
        $this->reset('state');
        $this->resetPage();
        $this->emit('filterTableReleases');
    }


    public function render()
    {
        return view('livewire.releases.filter');
    }
}

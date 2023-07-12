<?php

namespace App\Http\Livewire\Tenant\Ranking;

use Livewire\Component;
use Livewire\WithPagination;

class Filter extends Component
{
    use WithPagination;

    public $state = [
    ];

    public function submit()
    {
        $request = $this->state;
        $this->emit('filterTableRanking', $request);

    }

    public function clearFilter()
    {
        $this->reset();
        $this->emit('filterTableRanking', $request = null);
    }
    public function render()
    {
        return view('livewire.tenant.ranking.filter');
    }
}

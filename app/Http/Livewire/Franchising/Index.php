<?php

namespace App\Http\Livewire\Franchising;

use App\Http\Traits\WithModal;
use Livewire\Component;

class Index extends Component
{
    use WithModal;

    public function openModal()
    {
        dd('caiu');
    }

    public function render()
    {
        return view('livewire.franchising.index');
    }
}

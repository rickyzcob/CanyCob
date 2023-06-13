<?php

namespace App\Http\Livewire\Dashboard\Charges;

use App\Http\Traits\WithModal;
use Livewire\Component;

class Card extends Component
{
    use WithModal;

    public function render()
    {
        return view('livewire.dashboard.charges.card');
    }
}

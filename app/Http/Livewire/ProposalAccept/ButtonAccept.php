<?php

namespace App\Http\Livewire\ProposalAccept;

use App\Http\Traits\WithModal;
use Livewire\Component;

class ButtonAccept extends Component
{
    use WithModal;

    public function render()
    {
        return view('livewire.proposal-accept.button-accept');
    }
}

<?php

namespace App\Http\Livewire\Tenant\ProposalAccept;

use App\Http\Traits\WithModal;
use Livewire\Component;

class ButtonAccept extends Component
{
    use WithModal;

    public function render()
    {
        return view('livewire.tenant.proposal-accept.button-accept');
    }
}

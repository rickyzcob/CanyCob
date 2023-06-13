<?php

namespace App\Http\Livewire\Franchising;

use Livewire\Component;

class Form extends Component
{
    public $franchising;

    public function render()
    {
        return view('livewire.franchising.form');
    }
}

<?php

namespace App\Http\Livewire\Components;

use App\Http\Traits\WithModal;
use Livewire\Component;

class OpenModal3 extends Component
{

    use WithModal;

    protected $listeners = [
        'showModal3',
        'closeModal3'
    ];

    public $showModal3 = false;
    public $component = '';
    public $params = [];

    public function showModal3($compomemt = null, $params = null)
    {
        $this->showModal3 = true;
        $this->component = $compomemt;
        $this->params = $params;

    }

    public function closeModal3()
    {
        $this->showModal3 = false;
    }

    public function render()
    {
        return view('livewire.components.open-modal3');
    }
}

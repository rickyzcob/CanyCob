<?php

namespace App\Http\Livewire\Components;

use App\Http\Traits\WithModal;
use Livewire\Component;

class OpenModal2 extends Component
{
    use WithModal;

    protected $listeners = [
        'showModal2',
        'closeModal2'
    ];

    public $showModal2 = false;
    public $component = '';
    public $params = [];

    public function showModal2($compomemt = null, $params = null)
    {
        $this->showModal2 = true;
        $this->component = $compomemt;
        $this->params = $params;

    }

    public function closeModal2()
    {
        $this->showModal2 = false;
    }

    public function render()
    {
        return view('livewire.components.open-modal2');
    }
}

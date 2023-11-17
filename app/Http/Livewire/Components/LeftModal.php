<?php

namespace App\Http\Livewire\Components;

use App\Http\Traits\WithModal;
use Livewire\Component;

class LeftModal extends Component
{
    use WithModal;

    protected $listeners = ['showLeftModal', 'closeLeftModal'];

    public $showLeftModal = false;
    public $component = '';
    public $params = [];

    public function showLeftModal($compomemt = null, $params = null)
    {
        $this->showLeftModal = true;
        $this->component = $compomemt;
        $this->params = $params;
    }

    public function closeLeftModal()
    {
        $this->showLeftModal = false;
    }


    public function render()
    {
        return view('livewire.components.left-modal');
    }
}

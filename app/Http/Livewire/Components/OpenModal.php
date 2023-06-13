<?php

namespace App\Http\Livewire\Components;

use App\Http\Traits\WithModal;
use Livewire\Component;

class OpenModal extends Component
{
    use WithModal;

    protected $listeners = ['showModal', 'closeModal'];

    public $showModal = false;
    public $component = '';
    public $params = [];

    public function showModal($compomemt = null, $params = null)
    {
        $this->showModal = true;
        $this->component = $compomemt;
        $this->params = $params;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.components.open-modal');
    }
}

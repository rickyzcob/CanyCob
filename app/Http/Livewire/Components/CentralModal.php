<?php

namespace App\Http\Livewire\Components;

use App\Http\Traits\WithModal;
use Livewire\Component;

class CentralModal extends Component
{
    use WithModal;

    public $title = '';
    public $message = '';
    public $function = '';
    public $component = '';
    public $params = [];
    public $showCentralModal = false;

    protected $listeners = ['showCentralModal', 'closeCentralModal'];

    public function showCentralModal($component = null,  $title = null, $message = null, $params = null, $function = null)
    {
        $this->showCentralModal = true;
        $this->params = $params;
        $this->title = $title;
        $this->message = $message;
        $this->component = $component;
        $this->function = $function;;
    }

    public function closeCentralModal()
    {
        $this->showCentralModal = false;
    }

    public function render()
    {
        return view('livewire.components.central-modal');
    }
}

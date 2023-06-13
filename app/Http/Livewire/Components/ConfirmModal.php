<?php

namespace App\Http\Livewire\Components;

use App\Http\Traits\WithModal;
use Livewire\Component;

class ConfirmModal extends Component
{
    use WithModal;

    public $model_id;
    public $title = '';
    public $message = '';
    public $function = '';
    public $showConfirmModal = false;

    protected $listeners = ['showConfirmModal', 'closeConfirmModal'];

    public function showConfirmModal($modelid = null, $title = null, $message = null, $function = null)
    {
        $this->showConfirmModal = true;

        $this->model_id = $modelid;
        $this->title = $title;
        $this->message = $message;
        $this->function = $function;
    }

    public function closeConfirmModal()
    {
        $this->showConfirmModal = false;
    }


    public function render()
    {
        return view('livewire.components.confirm-modal');
    }
}

<?php

namespace App\Http\Traits;

trait
 WithModal
{
    public $showDeleteModal = false;
    public $type = '';

    public function openModal($component, $params = [], $modal = null)
    {
        if($modal == null) {;
            $this->emitTo('components.open-modal', 'showModal', $component,  $params);
        } else if ($modal == 2) {
            $this->emitTo('components.open-modal2', 'showModal2', $component,  $params);
        } else if ($modal == 3) {
            $this->emitTo('components.open-modal3', 'showModal3', $component,  $params);
        }
    }

    public function closeModals($modal = null)
    {
        if($modal == null) {
            $this->emitTo('components.open-modal', 'closeModal');
        } else if ($modal == 2) {
            $this->emitTo('components.open-modal2', 'closeModal2');
        } else if ($modal == 3) {
            $this->emitTo('components.open-modal3', 'closeModal3');
        }
    }

    public function openConfirmModal($modelid = null, $title = null, $message = null, $function = null)
    {
        $this->emitTo('components.confirm-modal', 'showConfirmModal',  $modelid, $title, $message, $function);
    }

    public function closeConfirmModal()
    {
        $this->emitTo('components.confirm-modal', 'closeConfirmModal');
    }

    public function openCentralModal($modelid = null, $component = null, $title = null, $message = null)
    {
        $this->emitTo('components.central-modal', 'showCentralModal', $modelid, $component, $title, $message);
    }

    public function closeCentralModal()
    {
        $this->emitTo('components.central-modal', 'closeCentralModal');
    }
}

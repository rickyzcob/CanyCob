<?php

namespace App\Http\Livewire\Tenant\Releases;

use App\Http\Traits\WithModal;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    use WithModal;
    public $exporting = false;
    public $exportFinished = false;


    protected $listeners = ['updateExportProgress'];

    public function updateExportProgress()
    {
        $this->exportFinished = true;

        if ($this->exportFinished) {
            $this->exporting = false;
        }
    }

    public function teste()
    {
        return Storage::download('export/lancamentos.xlsx');
    }

    public function render()
    {
        return view('livewire.tenant.releases.index');
    }
}

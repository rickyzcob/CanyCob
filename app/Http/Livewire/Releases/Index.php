<?php

namespace App\Http\Livewire\Releases;

use App\Http\Traits\WithModal;
use Livewire\Component;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;

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
        return view('livewire.releases.index');
    }
}

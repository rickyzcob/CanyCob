<?php

namespace App\Http\Livewire\Tenant\Releases;

use App\Repositories\ReleasesRepository;
use App\Repositories\TypeReleasesRepository;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Import extends Component
{
    use WithFileUploads, Actions;

    public $state = [
        'file' => '',
        'type_release_id' => ''
    ];

    public $batchId;
    public $importFile;
    public $importing = false;
    public $importFilePath;
    public $importFinished = false;

    public function submit()
    {

        $this->validate([
            'state.file' => 'required',
            'state.type_release_id' => 'required'
        ]);

        $this->importing = true;
        $this->importFilePath = $this->state['file']->store('imports');

        $releaseRepository = new ReleasesRepository();
        $releaseReturnDB = $releaseRepository->import($this->state['type_release_id'], $this->importFilePath);

        if($releaseReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Importação de arquivo',
                'description' => $releaseReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableReleases');

        } else if ($releaseReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $releaseReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }

        $this->batchId = $releaseReturnDB['data']->id;

    }

    public function getImportBatchProperty()
    {
        if (!$this->batchId) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }

    public function updateImportProgress()
    {
        $this->importFinished = $this->importBatch->finished();

        if ($this->importFinished) {
            Storage::delete($this->importFilePath);
            $this->importing = false;
        }
    }

    public function getSelectTypeReleases()
    {
        $typeReleasesRepository = new TypeReleasesRepository();
        return $typeReleasesRepository->getSelectTypeReleasesActive();
    }

    public function render()
    {
        $response = new \stdClass();
        $response->typeReleases = $this->getSelectTypeReleases();

        return view('livewire.tenant.releases.import',['response' => $response]);
    }
}

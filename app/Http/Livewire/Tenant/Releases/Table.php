<?php

namespace App\Http\Livewire\Tenant\Releases;

use App\Exports\ExportReleases;
use App\Http\Livewire\Releases\Bus;
use App\Http\Traits\WithModal;
use App\Repositories\ReleasesRepository;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use stdClass;
use WireUi\Traits\Actions;

class Table extends Component
{
    use Actions, WithModal, WithPagination;

    private $franchising;
    public $filters;

    public $pageSize = 10;

    public $batchId;
    public $exporting = false;
    public $exportFinished = false;

    public $order = [
        'column' => 'id',
        'order' => 'DESC'
    ];

    protected $listeners = [
        'refreshTableReleases' => '$refresh',
        'confirmDeleteReleases' => 'delete',
        'exportExcel' => 'export',
        'filterTableReleases'
    ];

    public function filterTableReleases($filterData = null)
    {
        $this->filters = $filterData;
        $this->resetPage();
    }
    public function getReleases()
    {
        $releaseRepository = new ReleasesRepository();
        $releaseReturnDB = $releaseRepository->index($this->filters, $this->pageSize, $this->order)['data'];

        return $releaseReturnDB;
    }

    public function export()
    {
        $this->exporting = true;
        $this->exportFinished = false;

        $releaseRepository = new ReleasesRepository();
        $releaseReturnDB = $releaseRepository->export($this->filters);

        if($releaseReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Exportação de arquivo',
                'description' => $releaseReturnDB['message'],
                'icon'        => 'success'
            ]);

            $this->emit('updateExportProgress', true);

            return Storage::download('export/lancamentos.xlsx');

        } else if ($releaseReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $releaseReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }

        $this->batchId = $releaseReturnDB['data']->id;


//        $this->batchId = $batch->id;
    }

    public function getExportBatchProperty()
    {
        if (!$this->batchId) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }

    public function downloadExport()
    {
        return Storage::download('public/transactions.csv');
    }

    public function updateExportProgress()
    {
        $this->exportFinished = $this->exportBatch->finished();

        $this->emit('updateExportProgress');

        if ($this->exportFinished) {
            $this->exporting = false;
        }
    }

    public function exportExcel()
    {
        return (new ExportReleases($this->filters))->download('lancamentos.xlsx');
    }

    public function delete($id = null)
    {
        $releaseRepository = new ReleasesRepository();
        $releaseReturnDB = $releaseRepository->delete($id);

        if($releaseReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Deletar !',
                'description' => $releaseReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeDeleteModal');
            $this->emit('refreshTableReleases');
        } else if ($releaseReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Deletar',
                'description' => $releaseReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeDeleteModal');
        }
    }

    public function render()
    {
        $response = new stdClass();
        $response->releases =  $this->getReleases();

        return view('livewire.tenant.releases.table', ['response' => $response]);
    }
}

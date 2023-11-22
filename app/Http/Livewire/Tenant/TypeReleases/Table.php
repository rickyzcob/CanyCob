<?php

namespace App\Http\Livewire\Tenant\TypeReleases;

use App\Http\Traits\WithModal;
use App\Repositories\TypeReleasesRepository;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use stdClass;

class Table extends Component
{
use Actions, WithModal, WithPagination;
    public $filters;

    public $pageSize = 10;

    public $order = [
        'column' => 'name',
        'order' => 'ASC'
    ];

    protected $listeners = [
        'refreshTableTypeReleases' => '$refresh',
        'confirmDeleteTypeReleases' => 'delete',
        'filterTableTypeReleases'
    ];

    public function filterTableTypeReleases($filterData = null)
    {
        $this->filters = $filterData;
        $this->resetPage();
    }

    public function getTypeReleases()
    {

        $typeReleasesRepository = new TypeReleasesRepository();
        $typeReleasesReturnDB = $typeReleasesRepository->index($this->filters, $this->pageSize, $this->order)['data'];

        return $typeReleasesReturnDB;
    }

    public function delete($id = null)
    {
        $typeReleasesRepository = new TypeReleasesRepository();
        $typeReleasesReturnDB = $typeReleasesRepository->delete($id);

        if($typeReleasesReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Deletar !',
                'description' => $typeReleasesReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeConfirmModal');
            $this->emit('refreshTableTypeReleases');
        } else if ($typeReleasesReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Deletar',
                'description' => $typeReleasesReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeConfirmModal');
        }
    }

    public function render()
    {
        $response = new stdClass();
        $response->typeReleases =  $this->getTypeReleases();

        return view('livewire.tenant.type-releases.table', ['response' => $response]);
    }
}

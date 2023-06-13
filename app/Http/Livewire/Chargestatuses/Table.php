<?php

namespace App\Http\Livewire\Chargestatuses;

use App\Http\Traits\WithModal;
use App\Repositories\ChargeStatusRepository;
use Livewire\Component;
use Livewire\WithPagination;
use stdClass;
use WireUi\Traits\Actions;

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
        'refreshTableChargeStatus' => '$refresh',
        'confirmDeleteChargeStatus' => 'delete',
        'filterTableChargeStatus'
    ];

    public function filterTableChargeStatus($filterData = null)
    {
        $this->filters = $filterData;
        $this->resetPage();
    }

    public function getChargeStatus()
    {

        $chargeStatusRepository = new ChargeStatusRepository();
        $chargeStatusReturnDB = $chargeStatusRepository->index($this->filters, $this->pageSize, $this->order)['data'];

        return $chargeStatusReturnDB;
    }

    public function delete($id = null)
    {
        $chargeStatusRepository = new ChargeStatusRepository();
        $chargeStatusReturnDB = $chargeStatusRepository->delete($id);

        if($chargeStatusReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Deletar !',
                'description' => $chargeStatusReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeConfirmModal');
            $this->emit('filterTableChargeStatus');
        } else if ($chargeStatusReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Deletar',
                'description' => $chargeStatusReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeConfirmModal');
        }
    }

    public function render()
    {
        $response = new stdClass();
        $response->chargeStatus =  $this->getChargeStatus();

        return view('livewire.chargestatuses.table', ['response' => $response]);
    }
}

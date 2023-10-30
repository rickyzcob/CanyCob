<?php

namespace App\Http\Livewire\Tenant\Fees;

use App\Http\Traits\WithModal;
use App\Repositories\ChargeStatusRepository;
use App\Repositories\FeesRepository;
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
        'refreshTableFees' => '$refresh',
        'confirmDeleteFees' => 'delete',
        'filterTableFees'
    ];

    public function filterTableFees($filterData = null)
    {
        $this->filters = $filterData;
        $this->resetPage();
    }

    public function getChargeStatus()
    {

        $feesRepository = new FeesRepository();
        $feesReturnDB = $feesRepository->index($this->filters, $this->pageSize, $this->order)['data'];

        return $feesReturnDB;
    }

    public function delete($id = null)
    {
        $feesRepository = new ChargeStatusRepository();
        $feesReturnDB = $feesRepository->delete($id);

        if($feesReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Deletar !',
                'description' => $feesReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeConfirmModal');
            $this->emit('refreshTableFees');
        } else if ($feesReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Deletar',
                'description' => $feesReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeConfirmModal');
        }
    }

    public function render()
    {
        $response = new stdClass();
        $response->fees =  $this->getChargeStatus();

        return view('livewire.tenant.fees.table', ['response' => $response]);
    }
}

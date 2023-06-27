<?php

namespace App\Http\Livewire\Tenant\Charges;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesFranchisingRepository;
use App\Repositories\FranchisingRepository;
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

    public $order = [
        'column' => 'created_at',
        'order' => 'ASC'
    ];

    protected $listeners = [
        'refreshTableChargesFranchising' => '$refresh',
        'confirmDelete' => 'delete',
        'filterTableChargesFranchising'
    ];

    public function filterTableChargesFranchising($filterData = null)
    {
        $this->filters = $filterData;
    }

    public function getChargesFranchising()
    {
        $franchisingRepository = new ChargesFranchisingRepository();
        $franchisingReturnDB = $franchisingRepository->index($this->filters, $this->pageSize, $this->order)['data'];

        return $franchisingReturnDB;
    }

    public function delete($id = null)
    {
        $franchisingRepository = new FranchisingRepository();
        $franchisingReturnDB = $franchisingRepository->delete($id);

        if($franchisingReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Deletar !',
                'description' => $franchisingReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeDeleteModal');
            $this->emit('refreshTableCategories');
        } else if ($franchisingReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Deletar',
                'description' => $franchisingReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeDeleteModal');
        }
    }

    public function render()
    {
        $response = new stdClass();
        $response->charges =  $this->getChargesFranchising();

        return view('livewire.tenant.charges.table', ['response' => $response]);
    }
}

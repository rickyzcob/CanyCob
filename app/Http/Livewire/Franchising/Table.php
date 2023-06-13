<?php

namespace App\Http\Livewire\Franchising;

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

    private $chargeFranchising;
    public $filters;

    public $pageSize = 10;

    public $order = [
        'column' => 'name',
        'order' => 'ASC'
    ];

    protected $listeners = [
        'refreshTableFranchising' => '$refresh',
        'confirmDeleteFranchising' => 'delete',
        'filterTableFranchising'
    ];

    public function filterTableFranchising($filterData = null)
    {
        $this->filters = $filterData;
    }

    public function getFranchising()
    {

        $chargeFranchisingRepository = new FranchisingRepository();
        $chargeFranchisingReturnDB = $chargeFranchisingRepository->index($this->filters, $this->pageSize, $this->order)['data'];

        return $chargeFranchisingReturnDB;
    }

    public function delete($id = null)
    {
        $chargeFranchisingRepository = new ChargesFranchisingRepository();
        $chargeFranchisingReturnDB = $chargeFranchisingRepository->delete($id);

        if($chargeFranchisingReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Deletar !',
                'description' => $chargeFranchisingReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeDeleteModal');
            $this->emit('refreshTableCategories');
        } else if ($chargeFranchisingReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Deletar',
                'description' => $chargeFranchisingReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeDeleteModal');
        }
    }

    public function render()
    {
        $response = new stdClass();
        $response->franchisings =  $this->getFranchising();

        return view('livewire.franchising.table', ['response' => $response]);
    }
}

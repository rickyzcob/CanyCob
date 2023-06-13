<?php

namespace App\Http\Livewire\Partners;

use App\Http\Traits\WithModal;
use App\Repositories\PartnersRepository;
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
        'refreshTablePartners' => '$refresh',
        'confirmDelete' => 'delete',
        'filterTablePartners'
    ];

    public function filterTablePartners($filterData = null)
    {
        $this->filters = $filterData;
        $this->resetPage();
    }

    public function getPartners()
    {

        $partnersRepository = new PartnersRepository();
        $partnersReturnDB = $partnersRepository->index($this->filters, $this->pageSize, $this->order)['data'];

        return $partnersReturnDB;
    }

    public function delete($id = null)
    {
        $partnersRepository = new PartnersRepository();
        $partnersReturnDB = $partnersRepository->delete($id);

        if($partnersReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Deletar !',
                'description' => $partnersReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeDeleteModal');
            $this->emit('refreshTablePartners');
        } else if ($partnersReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Deletar',
                'description' => $partnersReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeDeleteModal');
        }
    }

    public function render()
    {
        $response = new stdClass();
        $response->partners =  $this->getPartners();

        return view('livewire.partners.table', ['response' => $response]);
    }
}

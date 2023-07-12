<?php

namespace App\Http\Livewire\Tenant\Ranking;

use App\Http\Traits\WithModal;
use App\Repositories\CoinsRepository;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Table extends Component
{

    use Actions, WithModal, WithPagination;

    private $ranking;
    public $filters;

    public $pageSize = 10;

    public $order = [
        'column' => 'name',
        'order' => 'ASC'
    ];

    protected $listeners = [
        'refreshTableRanking' => '$refresh',
        'filterTableRanking'
    ];

    public function filterTableRanking($filterData = null)
    {
        $this->filters = $filterData;
        $this->resetPage();
    }

    public function getUsersByCoins()
    {
        $partnersRepository = new CoinsRepository();
        $partnersReturnDB = $partnersRepository->index($this->filters, $this->pageSize, $this->order)['data'];

        return $partnersReturnDB;
    }

    public function render()
    {
        $response = new \stdClass();
        $response->users = $this->getUsersByCoins();

        return view('livewire.tenant.ranking.table', ['response' => $response]);
    }
}

<?php

namespace App\Http\Livewire\Admin\Clients;

use App\Http\Traits\WithModal;
use App\Repositories\Admin\ClientsRepository;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Table extends Component
{
    use Actions, WithModal, WithPagination;

    private $users;

    public $filters;
    public $pageSize = 10;

    public $order = [
        'column' => 'name',
        'order' => 'ASC'];

    protected $listeners = [
        'refreshTableClients' => '$refresh',
        'confirmDeleteClients' => 'delete',
        'filterTableClients'
    ];

    public function filterTableClients ($filterData = null)
    {
        $this->filters = $filterData;
    }

    public function getClients()
    {

        $clientsRepository = new ClientsRepository();
        $usersReturnDB = $clientsRepository->index($this->filters, $this->pageSize, $this->order)['data'];

        return $usersReturnDB;
    }

    public function delete($id = null)
    {
        $clientsRepository = new ClientsRepository();
        $clientsReturnDB = $clientsRepository->delete($id);

        if($clientsReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Deletar !',
                'description' => $clientsReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeConfirmModal');
            $this->emit('refreshTableUsers');
        } else if ($clientsReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Deletar',
                'description' => $clientsReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeConfirmModal');
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->clients  =  $this->getClients();

        return view('livewire.admin.clients.table', ['response' => $response]);
    }
}

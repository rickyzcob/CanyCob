<?php

namespace App\Http\Livewire\Vendor\Users;

use App\Http\Traits\WithModal;
use App\Repositories\UserRepository;
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
        'refreshTableUsers' => '$refresh',
        'confirmDeleteUser' => 'delete',
        'filterTableUsers'
    ];

    public function filterTableUsers ($filterData = null)
    {
        $this->filters = $filterData;
    }

    public function getUsers()
    {

        $usersRepository = new UserRepository();
        $usersReturnDB = $usersRepository->index($this->filters, $this->pageSize, $this->order)['data'];

        return $usersReturnDB;
    }

    public function delete($id = null)
    {
        $usersRepository = new UserRepository();
        $categoryReturnDB = $usersRepository->delete($id);

        if($categoryReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Deletar !',
                'description' => $categoryReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeConfirmModal');
            $this->emit('refreshTableUsers');
        } else if ($categoryReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Deletar',
                'description' => $categoryReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeConfirmModal');
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->users  =  $this->getUsers();

        return view('livewire.vendor.users.table', ['response' => $response]);
    }
}

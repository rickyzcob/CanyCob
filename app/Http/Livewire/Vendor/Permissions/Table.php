<?php

namespace App\Http\Livewire\Vendor\Permissions;

use App\Http\Traits\WithModal;
use App\Repositories\RolesRepository;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Table extends Component
{
    use Actions, WithModal, WithPagination;

    private $roles;

    public $filters;
    public $pageSize = 10;

    public $order = [
        'column' => 'name',
        'order' => 'ASC'
    ];

    protected $listeners = [
        'refreshTableRoles' => '$refresh',
        'confirmDeleteRole' => 'delete',
        'filterTableRoles'
    ];

    public function filterTableRoles ($filterData = null)
    {
        $this->filters = $filterData;
    }

    public function getRoles()
    {

        $rolesRepository = new RolesRepository();
        $rolesReturnDB = $rolesRepository->index($this->filters, $this->pageSize, $this->order)['data'];

        return $rolesReturnDB;
    }

    public function delete($id = null)
    {
        $rolesRepository = new RolesRepository();
        $rolesReturnDB = $rolesReturnDBReturnDB = $rolesRepository->delete($id);

        if($rolesReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Deletar !',
                'description' => $rolesReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeConfirmModal');
            $this->emit('refreshTableCategories');
        } else if ($rolesReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Deletar',
                'description' => $rolesReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeConfirmModal');
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->roles  =  $this->getRoles();

        return view('livewire.vendor.permissions.table', ['response' => $response]);
    }
}

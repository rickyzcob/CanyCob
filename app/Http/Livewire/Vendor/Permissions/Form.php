<?php

namespace App\Http\Livewire\Vendor\Permissions;

use App\Http\Traits\WithModal;
use App\Repositories\RolesRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Form extends Component
{
    use Actions, WithModal;

    public $state = [
        'status' => '',
        'file' => ''
    ];

    public $role;

    public function mount($id = null)
    {
        $roleRepository = new RolesRepository();
        $roleReturnDB = $roleRepository->view($id)['data'];
        $this->role = $roleReturnDB;

        if($this->role){
            $this->state = $this->role->toArray();
        }

    }

    public function save()
    {
        if($this->role){
            return $this->update();
        }

        $request = $this->state;

        $roleRepository = new RolesRepository();
        $roleReturnDB = $roleRepository->create($request);

        if($roleReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $roleReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableRoles');


        } else if ($roleReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $roleReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }

    }

    public function update()
    {
        $request = $this->state;
        $roleRepository = new RolesRepository();

        $roleReturnDB = $roleRepository->update($this->role->id, $request);

        if($roleReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $roleReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableRoles');
        } else if ($roleReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $roleReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('livewire.vendor.permissions.form');
    }
}

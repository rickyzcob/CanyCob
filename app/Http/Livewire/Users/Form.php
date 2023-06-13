<?php

namespace App\Http\Livewire\Users;

use App\Repositories\RolesRepository;
use App\Repositories\UserRepository;
use App\Http\Traits\WithModal;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Form extends Component
{

    use Actions, WithModal, WithFileUploads;

    public $state = [
        'status' => '',
        'type' => '',
        'role_id' => '',
        'phone' => '',
        'document' => ''
    ];

    public $user;
    public $roles;

    public function mount($id = null)
    {
        $userRepository = new UserRepository();
        $userReturnDB = $userRepository->show($id)['data'];
        $this->user = $userReturnDB;

        if($this->user){
            $this->state = $this->user->toArray();
        }
    }

    public function save()
    {
        if($this->user){
            return $this->update();
        }

        $request = $this->state;

        $userRepository = new UserRepository();
        $userReturnDB = $userRepository->create($request);

        if($userReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $userReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableUsers');


        } else if ($userReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $userReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }

    }

    public function update()
    {
        $request = $this->state;
        $userRepository = new UserRepository();

        $userReturnDB = $userRepository->update($this->user->id, $request);

        if($userReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $userReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableUsers');
        } else if ($userReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $userReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function getRoles()
    {
        $roleRepository = new RolesRepository();
        $rolesReturnDB = $roleRepository->selectRoles();
        return $rolesReturnDB;
    }

    public function render()
    {
        $response = new \stdClass();
        $response->roles = $this->getRoles();

        return view('livewire.users.form', ['response' => $response]);
    }
}

<?php

namespace App\Http\Livewire\Permissions;

use App\Repositories\RolesRepository;
use App\Http\Traits\WithModal;
use App\Models\GroupPermissions;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use WireUi\Traits\Actions;

class Roles extends Component
{
    use Actions, WithModal;

    public $permissions = [];
    public $role;

    public function mount($id = null)
    {
        $roleRepository = new RolesRepository();
        $roleReturnDB = $roleRepository->view($id)['data'];

        $this->permissions = $roleReturnDB['permissions']->pluck('id')->toArray();
        $this->role = $roleReturnDB;

    }
    public function getRoles()
    {
        $groupPermissions = GroupPermissions::query()->with('permissions')->get();
        return $groupPermissions;
    }

    public function submit()
    {
        $request = $this->permissions;
        $roleRepository = new RolesRepository();

        $roleReturnDB = $roleRepository->syncPermissions($this->role->id, $request);

        if($roleReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Atualizado com Sucesso !',
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

//        Role::find($this->role->id)->syncPermissions($this->permissions);
    }

    public function render()
    {
        $response = new \stdClass();
        $response->groupPermissions = $this->getRoles();

        return view('livewire.permissions.roles', ['response' => $response]);
    }
}

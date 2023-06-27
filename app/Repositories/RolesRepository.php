<?php

namespace App\Repositories;

use App\Models\Roles;
use App\Requests\RoleRequest;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;
use Spatie\Permission\Models\Role;

class RolesRepository
{
    public function index($filterData = null, $pageSize, $orderBy)
    {

        try {
            $usersDB = Role::query();
            $usersDB->where('tenant_id', auth()->user()->tenant->id);

            if (isset($filterData['name']) && $filterData['name'] != null) {
                $usersDB->where('name', 'like', '%'.$filterData['name'].'%');
            }
            if(isset($filterData['status']) && $filterData['status'] != null){
                $usersDB->where('status', $filterData['status']);
            }

            $usersDB->orderBy($orderBy['column'], $orderBy['order']);

            $usersDB = $usersDB->paginate($pageSize);

            return [
                'status' => 'success',
                'data' => $usersDB,
                'code' => 202
            ];
        } catch (\PharIo\Version\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao Cadastrar'
            ];
        }
    }

    public function create($request)
    {
        $roleRequest = new RoleRequest();
        $requestValidated = $roleRequest->validate($request);

        $requestValidated['guard_name'] = session('tenant')['subdomain'];

        try {

            $rolesDB = Role::query()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $rolesDB,
                'code' => 200,
                'message' => 'Função cadastrado com sucesso !'
            ];


        } catch (Exception $exception){

            return [
                'status' => 'error',
                'data' => $exception,
                'code' => 400,
                'message' => 'Erro ao Cadastrar'
            ];

        }
    }

    public function update($id, $request)
    {
        $roleRequest = new RoleRequest();
        $requestValidated = $roleRequest->validate($request, $id);

        try {
            $roleDB = Roles::query()->findOrFail($id);

            $roleDB->update($requestValidated);

            return [
                'status' => 'success',
                'data' => $roleDB,
                'code' => 202,
                'message' => 'Categoria atualizada com sucesso !'
            ];

        }catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao Atualizar'
            ];
        }
    }

    public function syncPermissions($id, $request)
    {
        try {
            $roleDB = Role::query()->findOrFail($id);
            $roleDB->syncPermissions($request);

            return [
                'status' => 'success',
                'data' => $roleDB,
                'code' => 202,
                'message' => 'Categoria atualizada com sucesso !'
            ];

        }catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao Atualizar'
            ];
        }
    }

    public function view($id = null)
    {
        try {

        $roleDB = Role::query()->with('permissions')->find($id);


            return [
                'status' => 'success',
                'data' => $roleDB,
                'code' => 202,
                'message' => 'Função obtida com sucesso !'

            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao buscar a Categoria'
            ];
        }

    }

    public function selectRoles()
    {
        $roles = Role::query()->where('tenant_id', Auth::user()->tenant->id)->get();
        return $roles;
    }

    public function delete($id = null)
    {
        try {
            $roleDB = Roles::query()->findOrFail($id);

            $roleDB->delete();

            return [
                'status' => 'success',
                'data' => $roleDB,
                'code' => 202,
                'message' => 'Categoria apagado com sucesso !'
            ];

        }catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao aágar'
            ];
        }

    }
}

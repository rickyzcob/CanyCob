<?php

namespace App\Repositories\Admin;

use App\Models\Tenant;
use App\Models\Tenants;
use App\Repositories\Permissions\CreateRolesRepository;
use App\Repositories\Permissions\GivePermissionsByRole;
use App\Requests\ClientRequest;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;
use Spatie\Permission\Models\Role;

class ClientsRepository
{
    public function index($filterData = null, $pageSize = null, $orderBy = null)
    {

        try {
            $clientDB= Tenant::query()->with('user')->where('scope', 'Cliente');

            if (isset($filterData['name']) && $filterData['name'] != null) {
                $clientDB->where('name', 'like', '%'.$filterData['name'].'%');
            }
            if (isset($filterData['status']) && $filterData['status'] != null) {
                $clientDB->where('status', $filterData['status']);
            }

            $clientDB->orderBy($orderBy['column'], $orderBy['order']);

            $clientDB= $clientDB->paginate($pageSize);

            return [
                'status' => 'success',
                'data' => $clientDB,
                'code' => 200
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na Requisição'
            ];
        }
    }

    public function create($request)
    {
        $clientRequest = new ClientRequest();
        $requestValidated = $clientRequest->validate($request);

        $requestValidated['scope'] = 'Cliente';

        try {
            DB::beginTransaction();
            $clientDB = Tenant::query()->create($requestValidated);

            $createRolesRepository = new  CreateRolesRepository();
            $roleReturnDB = $createRolesRepository->createRolesbyClient($clientDB->id, 'web');

//            $createPermissionsRepository = new CreatePermissionsRepository();
//            $createPermissionsRepository->createPermissionsByClient($clientDB->subdomain);

            $roleDB = Role::query()->where('tenant_id', $clientDB->id)->where('name', 'Administrador')->first();

            $givPermissionsByProle = new GivePermissionsByRole();
            $givPermissionsByProle->givePermissionsAdministrator($roleDB->id);

            $userDB = $clientDB->user()->create([
                'tenant_id' => $clientDB->id,
                'name' => $requestValidated['user']['name'],
                'email' => $requestValidated['user']['email'],
                'phone' => $requestValidated['user']['phone'],
                'document' => $requestValidated['user']['document'],
                'status' => $requestValidated['user']['status'],
                'password' => $requestValidated['user']['password'],
                'role_id' => $roleDB->id
            ]);

            $userDB->assignRole($roleDB->id);

            Tenant::query()->find($clientDB->id)->update([
                'user_id' => $userDB->id
            ]);
            DB::commit();
            return [
                'status' => 'success',
                'data' => $clientDB,
                'code' => 200,
                'message' => 'Cliente cadastrado com sucesso !'
            ];
        } catch (Exception $exception){
            DB::rollBack();
            return [
                'status' => 'error',
                'data' => $exception,
                'code' => 400,
                'message' => 'Erro ao Cadastrar'
            ];

        }
    }

    public function update($request, $id)
    {
        $clientRequest = new ClientRequest();
        $requestValidated = $clientRequest->validate($request, $id);

        try {
            $clientDB= Tenant::query()->findOrFail($id);
            $clientDB->update($requestValidated);

            return [
                'status' => 'success',
                'data' => $clientDB,
                'code' => 202,
                'message' => 'Unidade atualizada com sucesso !'
            ];

        }catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao Atualizar'
            ];
        }
    }

    public function show($id)
    {
        try {
            $clientDB= Tenant::query()->with('user')->find($id);

            return [
                'status' => 'success',
                'data' => $clientDB,
                'code' => 200,

            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao buscar o Produto'
            ];
        }
    }

    public function delete($id = null)
    {
        try {
            $clientDB= Tenant::query()->findOrFail($id);
            $clientDB->delete();

            return [
                'status' => 'success',
                'data' => $clientDB,
                'code' => 200,
                'message' => 'Cliente deletado com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao deletar'
            ];
        }
    }
}

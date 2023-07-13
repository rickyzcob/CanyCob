<?php

namespace App\Repositories;

use App\Models\User;
use App\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use PHPUnit\Exception;

class UserRepository
{
    use WithPagination;

    public function index($filterData = null, $pageSize, $orderBy)
    {

        try {
            $usersDB = User::query()->with('role');

            if (isset($filterData['name']) && $filterData['name'] != null) {
                $usersDB->where('name', 'like', '%'.$filterData['name'].'%');
            }
            if(isset($filterData['status']) && $filterData['status'] != null){
                $usersDB->where('status', $filterData['status']);
            }

            $usersDB->orderBy($orderBy['column'], $orderBy['order']);

            if($pageSize){
                $usersDB = $usersDB->paginate($pageSize);
            } else {
                $usersDB = $usersDB->get();
            }

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
        $userRequest = new UserRequest();
        $requestValidated = $userRequest->validate($request);
        $requestValidated['coins'] = 0;

        try {
            DB::beginTransaction();

            $userDB = User::query()->create($requestValidated);
            $userDB->assignRole($requestValidated['role_id']);

            DB::commit();
            return [
                'status' => 'success',
                'data' => $userDB,
                'code' => 200,
                'message' => 'Usuário cadastrado com sucesso !'
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

    public function update($id, $request)
    {
        $userRequest = new UserRequest();
        $requestValidated = $userRequest->validate($request, $id);

        try {
            $userDB = User::query()->findOrFail($id);

            if($userDB->role_id == null){
                $userDB->assignRole($requestValidated['role_id']);
            } else {
                $userDB->removeRole($userDB->role_id);
                $userDB->assignRole($requestValidated['role_id']);
            }

            $userDB->update($requestValidated);

            return [
                'status' => 'success',
                'data' => $userDB,
                'code' => 200,
                'message' => 'Função atualizada com sucesso !'
            ];

        } catch (\Exception $exception) {

            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao Atualizar'
            ];
        }
    }

    public function updateProfile($id, $request)
    {
        $userRequest = new UserRequest();
        $requestValidated = $userRequest->validateProfile($request, $id);

        try {
            $userDB = User::query()->findOrFail($id);

            $userDB->update($requestValidated);
            $userDB->fresh();

            return [
                'status' => 'success',
                'data' => $userDB,
                'code' => 202,
                'message' => 'Dados atualizado com sucesso !'
            ];

        }catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao Atualizar'
            ];
        }
    }

    public function updatePassword($id, $request)
    {
        $userRequest = new UserRequest();
        $requestValidated = $userRequest->validatePassword($request, $id);

        try {
            $userDB = User::query()->findOrFail($id);

            $userDB->update($requestValidated);
            $userDB->fresh();

            return [
                'status' => 'success',
                'data' => $userDB,
                'code' => 202,
                'message' => 'Senha atualizado com sucesso !'
            ];

        }catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao Atualizar'
            ];
        }
    }

    public function uploadImage($id, $image)
    {

        try {
            $userDB = User::query()->findOrFail($id);

            if(isset($image) && $image != $userDB->image){
                if(Storage::exists('public/'.$userDB->image)) {
                    Storage::delete('public/'.$userDB->image);
                }
                $requestValidated['image'] = $image->store('users/image', 'public');
            } else {
                $requestValidated['image'] = $userDB->image;
            }


            $userDB->update($requestValidated);
            $userDB->fresh();

            return [
                'status' => 'success',
                'data' => $userDB,
                'code' => 202,
                'message' => 'Senha atualizado com sucesso !'
            ];

        }catch (\Exception $exception) {

            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao Atualizar'
            ];
        }
    }

    public function show($id)
    {
        try {
            $userDB = User::query()->find($id);

            return [
                'status' => 'success',
                'data' => $userDB,
                'code' => 202,
                'message' => 'Categoria obtida com sucesso !'

            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao buscar a Categoria'
            ];
        }
    }

    public function delete($id = null)
    {
        try {
            $userDB = User::query()->findOrFail($id);

            if($userDB->file != null){
                if(Storage::exists('public/'.$userDB->file)) {
                    Storage::delete('public/'.$userDB->file);
                }
            }

            $userDB->delete();

            return [
                'status' => 'success',
                'data' => $userDB,
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

    public function getSelectAttendantsActive()
    {
        try {
            $attendantsDB = User::query()->whereStatus('Ativo')->whereType('Colaborador')->orderBy('name', 'asc')->get()->toArray();

            return [
                'status' => 'success',
                'data' => $attendantsDB,
                'code' => 200,
            ];

        }catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
            ];
        }
    }
}

<?php

namespace App\Repositories;

use App\Models\TypeReleases;
use App\Requests\TypeReleasesRequest;
use PHPUnit\Exception;

class TypeReleasesRepository
{
    public function index($filterData = null, $pageSize, $orderBy)    {

        try {
            $typeReleasesDB = TypeReleases::query();

            if (isset($filterData['name']) && $filterData['name'] != null) {
                $typeReleasesDB->where('name', 'like', '%'.$filterData['name'].'%');
            }
            if (isset($filterData['status']) && $filterData['status'] != null) {
                $typeReleasesDB->where('status', $filterData['status']);
            }

            $typeReleasesDB->orderBy($orderBy['column'], $orderBy['order']);

            $typeReleasesDB = $typeReleasesDB->paginate($pageSize);

            return [
                'status' => 'success',
                'data' => $typeReleasesDB,
                'code' => 202
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao Cadastrar'
            ];
        }
    }

    public function create($request)
    {
        $chargeStatusRequest = new TypeReleasesRequest();
        $requestValidated = $chargeStatusRequest->validate($request);

        try {

            $typeReleasesDB = TypeReleases::query()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $typeReleasesDB,
                'code' => 200,
                'message' => 'Tipo de Lançamento cadastrado com sucesso !'
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
        $chargeStatusRequest = new TypeReleasesRequest();
        $requestValidated = $chargeStatusRequest->validate($request, $id);

        try {
            $typeReleasesDB = TypeReleases::query()->findOrFail($id);
            $typeReleasesDB->update($requestValidated);

            return [
                'status' => 'success',
                'data' => $typeReleasesDB,
                'code' => 200,
                'message' => 'Tipo de Lançamento atualizado com sucesso !'
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
            $typeReleasesDB = TypeReleases::query()->find($id);

            return [
                'status' => 'success',
                'data' => $typeReleasesDB,
                'code' => 200,
                'message' => 'Tipo de Lançamento obtido com sucesso !'

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
            $typeReleasesDB = TypeReleases::query()->findOrFail($id);
            $typeReleasesDB->delete();

            return [
                'status' => 'success',
                'data' => $typeReleasesDB,
                'code' => 200,
                'message' => 'Tipo de Lançamento deletado com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao deletar'
            ];
        }
    }

    public function getSelectTypeReleasesActive()
    {
        $typeReleasesDB = TypeReleases::query()->whereStatus('Ativo')->get()->toarray();
        return $typeReleasesDB;
    }

}

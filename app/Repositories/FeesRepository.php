<?php

namespace App\Repositories;

use App\Models\Fees;
use App\Requests\FeesRequest;
use PHPUnit\Exception;


class FeesRepository
{
    public function index($filterData = null, $pageSize, $orderBy)
    {

        try {
            $feesDB = Fees::query();

            if (isset($filterData['name']) && $filterData['name'] != null) {
                $feesDB->where('name', 'like', '%'.$filterData['name'].'%');
            }
            if (isset($filterData['status']) && $filterData['status'] != null) {
                $feesDB->where('status', $filterData['status']);
            }

            $feesDB->orderBy($orderBy['column'], $orderBy['order']);

            $feesDB = $feesDB->paginate($pageSize);

            return [
                'status' => 'success',
                'data' => $feesDB,
                'code' => 202
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao Cadastrar'
            ];
        }
    }

    public function create($request)
    {
        $feesRequest = new FeesRequest();
        $requestValidated = $feesRequest->validate($request);

        try {

            $feesDB = Fees::query()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $feesDB,
                'code' => 202,
                'message' => 'Taxa de juros cadastrado com sucesso !'
            ];


        } catch (Exception $exception){

            return [
                'status' => 'error',
                'data' => $exception,
                'code' => 200,
                'message' => 'Erro ao Cadastrar'
            ];

        }
    }

    public function update($id, $request)
    {
        $feesRequest = new FeesRequest();
        $requestValidated = $feesRequest->validate($request, $id);

        try {
            $feesDB = Fees::query()->findOrFail($id);
            $feesDB->update($requestValidated);

            return [
                'status' => 'success',
                'data' => $feesDB,
                'code' => 202,
                'message' => 'Taxa de Juros atualizado com sucesso !'
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
            $feesDB = Fees::query()->find($id);

            return [
                'status' => 'success',
                'data' => $feesDB,
                'code' => 202,
                'message' => 'Taxa obtido com sucesso !'

            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao buscar o Produto'
            ];
        }

    }

    public function delete($id = null)
    {
        try {
            $feesDB = Fees::query()->findOrFail($id);
            $feesDB->delete();

            return [
                'status' => 'success',
                'data' => $feesDB,
                'code' => 202,
                'message' => 'Taxa de Juros apagado com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao deletar'
            ];
        }
    }

    public function getAnualFeesSelect()
    {
        $feesDB = Fees::query()
            ->whereType('Year')
            ->whereStatus('Ativo')
            ->get()->toarray();

        return $feesDB;
    }

    public function getMonthFeesSelect()
    {
        $feesDB = Fees::query()
            ->whereType('Month')
            ->whereStatus('Ativo')
            ->get()->toarray();

        return $feesDB;
    }

}

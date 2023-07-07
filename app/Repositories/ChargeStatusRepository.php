<?php

namespace App\Repositories;

use App\Models\ChargeStatus;
use App\Requests\ChargeStatusRequest;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;

class ChargeStatusRepository
{
    public function index($filterData = null, $pageSize, $orderBy)    {

        try {
            $ChargeStatusDB = ChargeStatus::query();

            if (isset($filterData['name']) && $filterData['name'] != null) {
                $ChargeStatusDB->where('name', 'like', '%'.$filterData['name'].'%');
            }
            if (isset($filterData['status']) && $filterData['status'] != null) {
                $ChargeStatusDB->where('status', $filterData['status']);
            }

            $ChargeStatusDB->orderBy($orderBy['column'], $orderBy['order']);

            $ChargeStatusDB = $ChargeStatusDB->paginate($pageSize);

            return [
                'status' => 'success',
                'data' => $ChargeStatusDB,
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
        $chargeStatusRequest = new ChargeStatusRequest();
        $requestValidated = $chargeStatusRequest->validate($request);

        try {

            $ChargeStatusDB = ChargeStatus::query()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $ChargeStatusDB,
                'code' => 202,
                'message' => 'Status cadastrado com sucesso !'
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
        $chargeStatusRequest = new ChargeStatusRequest();
        $requestValidated = $chargeStatusRequest->validate($request, $id);

        try {
            $ChargeStatusDB = ChargeStatus::query()->findOrFail($id);
            $ChargeStatusDB->update($requestValidated);

            return [
                'status' => 'success',
                'data' => $ChargeStatusDB,
                'code' => 202,
                'message' => 'Status da Cobrança atualizado com sucesso !'
            ];

        }catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao Atualizar'
            ];
        }
    }

    public function view($id)
    {
        try {
            $ChargeStatusDB = ChargeStatus::query()->find($id);

            return [
                'status' => 'success',
                'data' => $ChargeStatusDB,
                'code' => 202,
                'message' => 'Produto obtido com sucesso !'

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
            $ChargeStatusDB = ChargeStatus::query()->findOrFail($id);
            $ChargeStatusDB->delete();

            return [
                'status' => 'success',
                'data' => $ChargeStatusDB,
                'code' => 202,
                'message' => 'Status de cobrança apagado com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao deletar'
            ];
        }
    }

    public function getSelectStatusCharge()
    {
        $ChargeStatusDB = ChargeStatus::query()->get()->toarray();
        return $ChargeStatusDB;
    }

    public function getSelectStatusChargeByValueAgreement($id = null )
    {

        $chargeRepository = new ChargesFranchisingRepository();
        $chargeReturnDB = $chargeRepository->show($id)['data'];

        if($chargeReturnDB['total_amount_corrected'] >= Auth::user()->value_agreement ){
            $ChargeStatusDB = ChargeStatus::query()->whereNot("id", $chargeReturnDB->status_id)->whereNotIn('id', [16, 17])->get()->toarray();
            return $ChargeStatusDB;
        } elseif ($chargeReturnDB['total_amount_corrected'] < Auth::user()->value_agreement){
            $ChargeStatusDB = ChargeStatus::query()->whereNot("id", $chargeReturnDB->status_id)->whereNotIn('id', [11,12,13,14,16,$id])->orderBy('name', 'ASC')->get()->toarray();
            return $ChargeStatusDB;
        }
    }



}

<?php

namespace App\Repositories;

use App\Models\PaymentMehod;
use App\Requests\PaymentMethodRequest;
use PHPUnit\Exception;

class PaymentMethodRepository
{

    public function index($filterData = null, $pageSize, $orderBy, $type_release_id)
    {

        try {
            $paymentMethodDB = PaymentMehod::query();

            $paymentMethodDB->where('type_release_id', $type_release_id);

            if (isset($filterData['name']) && $filterData['name'] != null) {
                $paymentMethodDB->where('name', 'like', '%'.$filterData['name'].'%');
            }
            if(isset($filterData['status']) && $filterData['status'] != null){
                $paymentMethodDB->where('status', $filterData['status']);
            }

            if(isset($filterData['type']) && $filterData['type'] != null){
                $paymentMethodDB->where('type', $filterData['type']);
            }

            $paymentMethodDB->orderBy($orderBy['column'], $orderBy['order']);

            $paymentMethodDB = $paymentMethodDB->paginate($pageSize);

            return [
                'status' => 'success',
                'data' => $paymentMethodDB,
                'code' => 200
            ];
        } catch (\PharIo\Version\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao Indexar'
            ];
        }
    }

    public function create($request, $type_release_id)
    {
        $paymentMethodRequest = new PaymentMethodRequest();
        $requestValidated = $paymentMethodRequest->validate($request);


        $requestValidated['type_release_id'] = $type_release_id;
        try {
            $paymentMethodDB = PaymentMehod::query()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $paymentMethodDB,
                'code' => 200,
                'message' => 'Tipo de pagamento cadastrado com sucesso !'
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
        $paymentMethodRequest = new PaymentMethodRequest();
        $requestValidated = $paymentMethodRequest->validate($request, $id);

        try {
            $paymentMethodDB = PaymentMehod::query()->findOrFail($id);

            $paymentMethodDB->update($requestValidated);

            return [
                'status' => 'success',
                'data' => $paymentMethodDB,
                'code' => 200,
                'message' => 'Tipo de pagamento atualizado com sucesso !'
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
            $paymentMethodDB = PaymentMehod::query()->find($id);

            return [
                'status' => 'success',
                'data' => $paymentMethodDB,
                'code' => 200,
                'message' => 'Tipo de pagamento obtido com sucesso !'

            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na requisição'
            ];
        }

    }

    public function delete($id = null)
    {
        try {
            $paymentMethodDB = PaymentMehod::query()->findOrFail($id);
            $paymentMethodDB->delete();

            return [
                'status' => 'success',
                'data' => $paymentMethodDB,
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

    public function getSelectPaymentByActive($type_release_id  = null)
    {
        try {
            $paymentMethodDB = PaymentMehod::query()->whereStatus('Ativo');

            if($type_release_id){
                $paymentMethodDB->where('type_release_id', $type_release_id);
            }

             $paymentMethodDB = $paymentMethodDB->get()->toarray();

            return [
                'status' => 'success',
                'data' => $paymentMethodDB,
                'code' => 200,
            ];

        } catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 401,
            ];
        }
    }

}

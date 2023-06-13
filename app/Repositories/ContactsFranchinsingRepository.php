<?php

namespace App\Repositories;

use App\Models\ContactsFranchisings;
use App\Requests\ContactsFranchisingRequest;
use PHPUnit\Exception;

class ContactsFranchinsingRepository
{

    public function view($id)
    {
        try {
            $contactDB = ContactsFranchisings::query()->find($id);

            return [
                'status' => 'success',
                'data' => $contactDB,
                'code' => 202,
                'message' => 'Contato obtido com sucesso !'

            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao buscar o Produto'
            ];
        }

    }

    public function getContactsFranchisings($franchisings_id = null)
    {
        $partnerfranchisings = ContactsFranchisings::query()
            ->where('franchising_id', $franchisings_id)
            ->orderBy('name')
            ->get()->toArray();

        return $partnerfranchisings;

    }

    public function create($request, $franchising_id)
    {

        $contactFranchisingRequest = new ContactsFranchisingRequest();
        $requestValidated = $contactFranchisingRequest->validate($request);

        $requestValidated['franchising_id'] = $franchising_id;

        try {

            $contactDB = ContactsFranchisings::query()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $contactDB,
                'code' => 202,
                'message' => 'Funcionário cadastrado com sucesso !'
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
        $partnerRequest = new ContactsFranchisingRequest();
        $requestValidated = $partnerRequest->validate($request, $id);

        try {
            $partnerDB = ContactsFranchisings::query()->findOrFail($id);
            $partnerDB->update($requestValidated);

            return [
                'status' => 'success',
                'data' => $partnerDB,
                'code' => 202,
                'message' => 'Funcionário atualizado com sucesso !'
            ];

        }catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao Atualizar'
            ];
        }
    }

    public function delete($id = null)
    {
        try {
            $contactDB = ContactsFranchisings::query()->find($id);
            $contactDB->delete();

            return [
                'status' => 'success',
                'code' => 202,
                'message' => 'Funcionário apagado com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao deletar'
            ];
        }
    }


}

<?php

namespace App\Repositories;

use App\Http\Repository\PartnerRequest;
use App\Models\Partners;
use App\Models\PartnersFranchisings;
use App\Requests\PartnerFranchisingRequest;
use App\Requests\PartnersRequest;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class PartnersRepository
{
    public function index($filterData = null, $pageSize, $orderBy)
    {

        try {
            $partnerDB = Partners::query();

            if (isset($filterData['name']) && $filterData['name'] != null) {
                $partnerDB->where('name', 'like', '%'.$filterData['name'].'%');
            }
            if (isset($filterData['email']) && $filterData['email'] != null) {
                $partnerDB->where('email', 'like', '%'.$filterData['email'].'%');
            }
            if (isset($filterData['cpf']) && $filterData['cpf'] != null) {
                $partnerDB->where('cpf', 'like', '%'.$filterData['cpf'].'%');
            }

            $partnerDB->orderBy($orderBy['column'], $orderBy['order']);

            $partnerDB = $partnerDB->paginate($pageSize);

            return [
                'status' => 'success',
                'data' => $partnerDB,
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
        $partnerRequest = new PartnersRequest();
        $requestValidated = $partnerRequest->validate($request);

        try {

//            if($requestValidated['image'] != null){
//                $requestValidated['image'] = $requestValidated['image']->store('Partner', 'public');
//            }

            $partnerDB = Partners::query()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $partnerDB,
                'code' => 202,
                'message' => 'Sócio cadastrado com sucesso !'
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
        $partnerRequest = new PartnerRequest();
        $requestValidated = $partnerRequest->validate($request, $id);

        try {
            $partnerDB = Partners::query()->findOrFail($id);

//            if(isset($requestValidated['image']) && $requestValidated['image'] != $partnerDB->image){
//                if(Storage::exists('public/'.$partnerDB->image)) {
//                    Storage::delete('public/'.$partnerDB->image);
//                }
//                $requestValidated['image'] = $requestValidated['image']->store('Franchising', 'public');
//            }
            $partnerDB->update($requestValidated);

            return [
                'status' => 'success',
                'data' => $partnerDB,
                'code' => 202,
                'message' => 'Sócio atualizado com sucesso !'
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
            $partnerDB = Partners::query()->find($id);

            return [
                'status' => 'success',
                'data' => $partnerDB,
                'code' => 202,
                'message' => 'Sócio obtido com sucesso !'

            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao buscar o Sócio'
            ];
        }

    }

    public function delete($id = null)
    {
        try {
            $partnerDB = Partners::query()->findOrFail($id);

            if ($partnerDB->file != null) {
                if (Storage::exists('public/' . $partnerDB->file)) {
                    Storage::delete('public/' . $partnerDB->file);
                }
            }

            $partnerDB->delete();

            return [
                'status' => 'success',
                'data' => $partnerDB,
                'code' => 202,
                'message' => 'Sócio apagado com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao deletar'
            ];
        }
    }

    public function getSelectPartner()
    {
        try {
            $partnerDB = Partners::query()->get()->toarray();

            return [
                'status' => 'success',
                'data' => $partnerDB,
                'code' => 200,
            ];

        } catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 401,
            ];
        }
    }

    public function getSelectPartnersByFranchising($franchising_id = null)
    {
//        dd($franchising_id);
        $sortDirection = 'ASC';
        $partnerfranchisings = PartnersFranchisings::query()->with(['partner' => function ($query) use ($sortDirection) {
            $query->orderBy('name', $sortDirection);
        }])
            ->where('franchising_id', $franchising_id)
            ->get()
            ->toArray();


        return $partnerfranchisings;


    }

    public function getPartnersFranchisings($franchisings_id = null)
    {
        $sortDirection = 'ASC';

        $partnerfranchisings = PartnersFranchisings::query()->with(['partner' => function ($query) use ($sortDirection) {
            $query->orderBy('name', $sortDirection);
        }])
            ->where('franchising_id', $franchisings_id)
            ->get()->toArray();

        return $partnerfranchisings;

    }

    public function addPartnerFranchising($request, $franchising_id)
    {

        $partnerFranchisingRequest = new PartnerFranchisingRequest();
        $requestValidated = $partnerFranchisingRequest->validate($request);

        $requestValidated['franchising_id'] = $franchising_id;

        try {

//            if($requestValidated['image'] != null){
//                $requestValidated['image'] = $requestValidated['image']->store('Partner', 'public');
//            }

            $partnerDB = PartnersFranchisings::query()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $partnerDB,
                'code' => 202,
                'message' => 'Sócio cadastrado com sucesso !'
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
}

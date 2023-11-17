<?php

namespace App\Repositories;

use App\Jobs\ImportReleasesJob;
use App\Models\Franchisings;
use App\Requests\FranchisingRequest;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class FranchisingRepository
{

    public function index($filterData = null, $pageSize, $orderBy)
    {
        try {
            $franchisingDB = Franchisings::query()->with('statusFran', 'attendant');

            if (isset($filterData['name']) && $filterData['name'] != null) {
                $franchisingDB->where('name', 'like', '%'.$filterData['name'].'%');
            }
            if(isset($filterData['status']) && $filterData['status'] != null){
                $franchisingDB->where('status', $filterData['status']);
            }
            if(isset($filterData['category_id']) && $filterData['category_id'] != null){
                $franchisingDB->where('category_id', $filterData['category_id']);
            }
            if(isset($filterData['brand_id']) && $filterData['brand_id'] != null){
                $franchisingDB->where('brand_id', $filterData['brand_id']);
            }

            $franchisingDB->orderBy($orderBy['column'], $orderBy['order']);

            $franchisingDB = $franchisingDB->paginate($pageSize);

            return [
                'status' => 'success',
                'data' => $franchisingDB,
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
        $franchisingRequest = new FranchisingRequest();
        $requestValidated = $franchisingRequest->validate($request);

        $requestValidated['user_id'] = auth()->user()->id;

        try {

//            if($requestValidated['image'] != null){
//                $requestValidated['image'] = $requestValidated['image']->store('Franchising', 'public');
//            }

            $franchisingDB = Franchisings::query()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $franchisingDB,
                'code' => 202,
                'message' => 'Franqueado cadastrado com sucesso !'
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
        $franchisingRequest = new FranchisingRequest();
        $requestValidated = $franchisingRequest->validate($request, $id);

        try {
            $franchisingDB = Franchisings::query()->findOrFail($id);

            if(isset($requestValidated['image']) && $requestValidated['image'] != $franchisingDB->image){
                if(Storage::exists('public/'.$franchisingDB->image)) {
                    Storage::delete('public/'.$franchisingDB->image);
                }
                $requestValidated['image'] = $requestValidated['image']->store('Franchising', 'public');
            }
            $franchisingDB->update($requestValidated);

            return [
                'status' => 'success',
                'data' => $franchisingDB,
                'code' => 202,
                'message' => 'Produto atualizado com sucesso !'
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

            $franchisingDB = Franchisings::query()->with('partners.partner', 'attendant')->find($id);

            return [
                'status' => 'success',
                'data' => $franchisingDB,
                'code' => 202,
                'message' => 'Unidade obtida com sucesso !'

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
            $franchisingDB = Franchisings::query()->findOrFail($id);

            if ($franchisingDB->file != null) {
                if (Storage::exists('public/' . $franchisingDB->file)) {
                    Storage::delete('public/' . $franchisingDB->file);
                }
            }

            $franchisingDB->delete();

            return [
                'status' => 'success',
                'data' => $franchisingDB,
                'code' => 202,
                'message' => 'Produto deletado com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao deletar'
            ];
        }
    }

    public function getSelectFranchisingByActive()
    {
        try {
            $franchisingDB = Franchisings::query()->whereStatus('Ativo')->get()->toarray();

            return [
                'status' => 'success',
                'data' => $franchisingDB,
                'code' => 200,
            ];

        } catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 401,
            ];
        }
    }

    public function import($file)
    {
        sleep(2);

        $batch = Bus::batch([
            new ImportReleasesJob($file),
        ])->dispatch();
    }

}

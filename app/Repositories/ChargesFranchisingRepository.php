<?php

namespace App\Repositories;

use App\Models\ChargeHistoric;
use App\Models\Charges;
use App\Models\ProposalAccept;
use App\Models\Releases;
use PHPUnit\Exception;

class ChargesFranchisingRepository
{

    public function index($filterData = null, $pageSize, $orderBy)
    {
//        dd($filterData);
        try {
            $franchisingDB = Charges::query()->with('releases','attendant', 'franchising');

//                ->where('status_id', 1)
            $franchisingDB->whereHas('releases', function ($query) {
                    $query->whereIn('status_id', [2,3,6,8,9])->orderBy('created_at', 'DESC');
                });

            if (isset($filterData['name']) && $filterData['name'] != null) {
//                $franchisingDB->where('name', 'like', '%'.$filterData['name'].'%');
                $franchisingDB->whereHas('franchising', function ($query) use ($filterData){
                    $query->where('name', 'like', '%'.$filterData['name'].'%');
                });
            }
            if(isset($filterData['status_id']) && $filterData['status_id'] != null){
                $franchisingDB->whereIn('status_id', $filterData['status_id']   );
            }
//            $franchisingDB->orderBy($orderBy['column'], $orderBy['order   ']);

            if(auth()->user()->can('view_charges_user')) {
                $franchisingDB->where('attendant_id', auth()->user()->id);
                $franchisingDB = $franchisingDB->paginate($pageSize);
            } else if (auth()->user()->can('view_charges_all')) {
                $franchisingDB = $franchisingDB->paginate($pageSize);
            }

            return [
                'status' => 'success',
                'data' => $franchisingDB,
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

    public function show($id)
    {
        try {
            $ChargeStatusDB = Charges::query()->with(
                ['franchising', 'proposals', 'proposalAccept', 'releases','agreementByCharge','status', 'totalHistorics', 'historics'  => function ($query) use ($id) {
                $query->where('charge_id', $id)->orderBy('created_at', 'DESC')->first();
            }])->where('id', $id)->first();

            return [
                'status' => 'success',
                'data' => $ChargeStatusDB,
                'code' => 202,
            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao buscar o Produto'
            ];
        }

    }

    public function showByReference($reference = null)
    {
        try {
            $ChargeReturnDB = Charges::query()->with('franchising', 'proposals', 'proposalAccept',
                'releases','agreementByCharge','status', 'totalHistorics'
                )->where('reference', $reference)->first();

            return [
                'status' => 'success',
                'data' => $ChargeReturnDB,
                'code' => 202,
            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao buscar o Produto'
            ];
        }
    }

    public function getLastChargeHistoric($charge_id)
    {
        try {
            $chargeHistoricDB = ChargeHistoric::query()->where('charge_id', $charge_id)->orderBy('created_at', 'DESC')->first();
            return [
                'status' => 'success',
                'data' => $chargeHistoricDB,
                'code' => 202,
                'message' => 'Status Alterado com sucesso !'
            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao buscar o Produto'
            ];
        }

    }

    public function changeStatus($charge_id, $status_id)
    {
        try{
            $chargeReturnDB = Charges::query()->findOrFail($charge_id);

            $chargeReturnDB->update([
                'status_id' => $status_id
            ]);

            $releasesDB = Releases::query()->where('charge_id', $charge_id)->get();
            $proposalAcceptDB = ProposalAccept::query()->find($chargeReturnDB['proposal_accept_id']);

            if($status_id == 9) {
                foreach($releasesDB as $itemRelease){
                    $itemRelease->status_id = 3;
                    $itemRelease->update();
                }
            } else if ($status_id == 11){
                foreach($releasesDB as $itemRelease){
                    $itemRelease->status_id = 2;
                    $itemRelease->update();
                }
            } else if ($status_id == 12){
                if($proposalAcceptDB && $proposalAcceptDB['accept'] == 'Sim'){
                    $chargeReturnDB->update([
                        'agreement' => 1
                    ]);
                    foreach($releasesDB as $itemRelease) {
                        $itemRelease->status_id = 6;
                        $itemRelease->update();
                    }
                } else {
                    return [
                        'status' => 'error',
                        'code' => 200,
                        'message' => 'A Proposta Ainda não foi aceita pelo Sócio vinculado aguarde ele aceitar para mudar o status para Acordo'
                    ];
                }
            } else if ($status_id == 13  ) {
                foreach($releasesDB as $itemRelease){
                    $itemRelease->status_id = 9;
                    $itemRelease->update();
                }
            } else if ($status_id == 14  ) {
                foreach($releasesDB as $itemRelease){
                    $itemRelease->status_id = 8;
                    $itemRelease->update();
                }
            }


            return [
                'status' => 'success',
                'data' => $chargeReturnDB->fresh(),
                'message' => 'Status alterado com sucesso !',
                'code' => 202,
            ];


        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao buscar o Produto'
            ];

        }

    }


}

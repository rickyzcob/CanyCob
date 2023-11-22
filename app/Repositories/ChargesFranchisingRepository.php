<?php

namespace App\Repositories;

use App\Models\ChargeHistoric;
use App\Models\Charges;
use App\Models\Configurations;
use App\Models\ProposalAccept;
use App\Models\Proposals;
use App\Models\Releases;
use App\Notifications\NotifyChargeFranchising;
use App\Notifications\NotifyProposalAccept;
use App\Notifications\NotifySendProposalAccept;
use App\Requests\ConferenceRequest;
use App\Requests\ReleasesRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class ChargesFranchisingRepository
{

    public function index($filterData = null, $pageSize, $orderBy)
    {
        try {
            $franchisingDB = Charges::query()->with('releases','attendant', 'franchising');

            $franchisingDB->whereHas('releases', function ($query) {
                    $query->whereIn('status_id', [2,3,4,5,6,8,9,10])->orderBy('created_at', 'DESC');
                });

            if (isset($filterData['name']) && $filterData['name'] != null) {

                $franchisingDB->whereHas('franchising', function ($query) use ($filterData){
                    $query->where('name', 'like', '%'.$filterData['name'].'%');
                });
            }
            if(isset($filterData['status_id']) && $filterData['status_id'] != null){
                $franchisingDB->whereIn('status_id', $filterData['status_id']   );
            }

            $franchisingDB->orderBy($orderBy['column'], $orderBy['order']);

            if(auth()->user()->can('tenant_view_charges_user') && auth()->user()->can('tenant_view_charges_all')){
                $franchisingDB = $franchisingDB->paginate($pageSize);
            }else if(auth()->user()->can('tenant_view_charges_user') && !auth()->user()->can('tenant_view_charges_all')) {
                $franchisingDB->where('attendant_id', auth()->user()->id);
                $franchisingDB = $franchisingDB->paginate($pageSize);
            } else if (auth()->user()->can('tenant_view_charges_all') && !auth()->user()->can('tenant_view_charges_user')) {
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
                'code' => 400,
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
                'code' => 200,
            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na requisição'
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

    public function addPaymentCode($request, $charge_id)
    {
        $releasesRequest = new ConferenceRequest();
        $requestValidated = $releasesRequest->validate($request);

        try {

            $chargeDB = Charges::query()->where('id', $charge_id)->update(['payment_code' => $requestValidated['payment_code']]);

            return [
                'status' => 'success',
                'data' => $chargeDB,
                'code' => 200,
                'message' => 'Codigo Adicionado com sucesso !'
            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na requisição'
            ];
        }

    }

    public function changeStatus($charge_id, $status_id)
    {
        try{

            DB::beginTransaction();
            $chargeReturnDB = Charges::query()->with('agreementByCharge')->findOrFail($charge_id);

            $releasesDB = Releases::query()->where('charge_id', $charge_id)->get();
            $proposalAcceptDB = ProposalAccept::query()->find($chargeReturnDB['proposal_accept_id']);

            $getLastHistoric = ChargeHistoric::query()->where('type', 'Phone')->where('charge_id', $charge_id)->orderBy('created_at', 'DESC')->first();


            if($status_id == 9) {
                DB::commit();
                $chargeReturnDB->update([
                    'agreement' => 0,
                    'concluded' => 'Não',
                    'status_id' => $status_id
                ]);
                foreach($releasesDB as $itemRelease){
                    $itemRelease->status_id = 3;
                    $itemRelease->update();
                }
            } else if ($status_id == 11){
                $chargeReturnDB->update([
                    'status_id' => $status_id
                ]);
                foreach($releasesDB as $itemRelease){
                    $itemRelease->status_id = 2;
                    $itemRelease->update();
                }
            } else if ($status_id == 12){
                DB::commit();
                if ($chargeReturnDB->total_amount_corrected < Auth::user()->value_agreement) {
                    return [
                        'status' => 'error',
                        'code' => 400,
                        'message' => 'O Valor da Dívida é menor que o necessário para gerar o acordo.'
                    ];
                }
                if($proposalAcceptDB && $proposalAcceptDB['accept'] == 'Sim' ){
                    $chargeReturnDB->update([
                        'agreement' => 1,
                        'status_id' => $status_id
                    ]);
                    foreach($releasesDB as $itemRelease) {
                        $itemRelease->status_id = 6;
                        $itemRelease->update();
                    }
                } else {
                    DB::rollBack();
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
            } else if ($status_id == 15) {
                $request = [];

                DB::commit();
                $coinsRepository = new CoinsRepository();

                if($chargeReturnDB->total_amount_corrected < Auth::user()->value_agreement) {
                    if($chargeReturnDB['payment_code'] != null || $chargeReturnDB['status_id'] == 17) {

                        $chargeReturnDB->update([
                            'status_id' => $status_id,
                            'concluded' => 'Sim'
                        ]);

                        $request['description'] = 'Pontuação por acordo concluído';
                        $coinsReturnDB = $coinsRepository->create($request, 'Cobrança', $chargeReturnDB->attendant_id);

                        foreach ($releasesDB as $itemRelease) {
                            $itemRelease->status_id = 4;
                            $itemRelease->update();
                        }
                    }  else {
                        DB::rollBack();
                        return [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'Voce nao pode concluir a cobrança sem adicionar o codigo de pagamento do lançamento'
                        ];
                    }
                } else if ($chargeReturnDB->total_amount_corrected > Auth::user()->value_agreement) {
                    if($chargeReturnDB['agreementByCharge'] && ($chargeReturnDB['agreementByCharge']['status_id'] == 5 || $chargeReturnDB['agreementByCharge']['status_id'] == 4)) {

                        $chargeReturnDB->update([
                            'status_id' => $status_id,
                            'concluded' => 'Sim'
                        ]);

                        $request['description'] = 'Pontuação por acordo concluído';
                        $coinsReturnDB = $coinsRepository->create($request, 'Acordo', $chargeReturnDB->attendant_id);

                        foreach ($releasesDB as $itemRelease) {
                            $itemRelease->status_id = 4;
                            $itemRelease->update();
                        }
                    }  else {
                        DB::rollBack();
                        return [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'Voce nao pode concluir a cobrança sem que o Acordo estiver assinado ou concluído'
                        ];
                    }
                }

            } else if ($status_id == 17) {
                if($getLastHistoric && $getLastHistoric['success'] == 'Sim') {
                    DB::commit();

                    $chargeReturnDB->update([
                        'status_id' => $status_id,
                        'agreement' => 1
                    ]);
                    foreach ($releasesDB as $itemRelease) {
                        $itemRelease->status_id = 10;
                        $itemRelease->update();
                    }
                }  else {
                    DB::rollBack();
                    return [
                        'status' => 'error',
                        'code' => 200,
                        'message' => 'Com base no Histórico ainda nao teve um retorno com sucesso para avançar o status'
                    ];
                }
            }
            return [
                'status' => 'success',
                'data' => $chargeReturnDB->fresh(),
                'message' => 'Status alterado com sucesso !',
                'code' => 200,
            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na Requisição'
            ];
        }
    }

    public function getDontChargesByUser()
    {

        $now = Carbon::now();
        //        $date = \Carbon\Carbon::today()->subDays(10);

//        dd($now->toDateTimeString());
        try {
            $franchisingDB = Charges::query()->with(['releases','attendant', 'franchising',
                'lastHistoric' => function ($query) {
                    $query->where('success', 'Não');
                    $query->orderBy('created_at', 'DESC')->first();
                }]);

            $franchisingDB->where('status_id', 9);
            $franchisingDB->whereDate('date_schedule', $now);

//            $franchisingDB->whereHas('lastHistoric', function ($query) use ($now) {
//                $query->whereDate('date_schedule', $now);
//            });

            $franchisingDB->whereHas('releases', function ($query) {
                $query->whereIn('status_id', [2,3,6,8,9])->orderBy('created_at', 'DESC');
            });

            $franchisingDB->orderBy('created_at', 'DESC');

            if(auth()->user()->can('view_charges_user')) {
                $franchisingDB->where('attendant_id', auth()->user()->id);
                $franchisingDB = $franchisingDB->get();
            } else if (auth()->user()->can('view_charges_all')) {
                $franchisingDB = $franchisingDB->get();
            }

//            dd($franchisingDB);
            return [
                'status' => 'success',
                'data' => $franchisingDB,
                'code' => 200
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na requisição'
            ];
        }
    }

    public function sentProposalAccept($id = null)
    {
        $proposalDB = ProposalAccept::query()->with('partner', 'charge.attendant')->findOrFail($id);
        $mytime = Carbon::now()->format('d/m/Y');

        try {
            if($proposalDB['partner']['email'] == null){
                return [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'O sócio Cadastrado nao tem um email valido'
                ];

            } elseif ($proposalDB['status'] == 'Inativo'){
                return [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Proposta está Inativa'
                ];
            } else {
                $partner = $proposalDB['partner'];
                $sent = $partner->notify( new NotifySendProposalAccept($proposalDB));

                return [
                    'status' => 'success',
                    'data' => $sent,
                    'code' => 200,
                    'message' => 'Termo enviado com sucesso !'
                ];
            }

        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao enviar o email'
            ];
        }
    }

    public function getChargesByConference()
    {
        $now = Carbon::now();
        $end = \Carbon\Carbon::today()->addWeekday(3);

        $date_start = Carbon::parse($now)->format('Y-m-d');
        $date_end = Carbon::parse($end)->format('Y-m-d');


        try {
            $franchisingDB = Charges::query()->with('releases','attendant', 'franchising', 'historics');

            $franchisingDB->where('status_id', 17);

            $franchisingDB->whereHas('historics', function ($query) use ($date_start, $date_end) {
                $query->whereDate('date_conference', '>=', $date_start AND 'date_conference', '<=', $date_end );

            });

            $franchisingDB->whereHas('releases', function ($query) {
                $query->where('status_id', 10)->orderBy('created_at', 'DESC');
            });

            $franchisingDB->orderBy('created_at', 'DESC');

            if(auth()->user()->can('view_charges_user')) {
                $franchisingDB->where('attendant_id', auth()->user()->id);
                $franchisingDB = $franchisingDB->get();
            } else if (auth()->user()->can('view_charges_all')) {
                $franchisingDB = $franchisingDB->get();
            }

            return [
                'status' => 'success',
                'data' => $franchisingDB,
                'code' => 200
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na requisição'
            ];
        }
    }

}

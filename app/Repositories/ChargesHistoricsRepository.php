<?php

namespace App\Repositories;

use App\Models\ChargeHistoric;
use App\Models\Charges;
use App\Models\ChargeSchedule;
use App\Models\Partners;
use App\Models\Proposals;
use App\Notifications\NotifyChargeFranchising;
use App\Requests\ChargeHistoricRequest;
use App\Requests\SimulateRequest;
use App\Services\SendWhatsappService;
use App\Services\SimulationService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class ChargesHistoricsRepository
{
    public function index($id)
    {
        try {
            $chargesHistoricDB = ChargeHistoric::query()->where('charge_id', $id)->orderBy('created_at', 'DESC')->get();

            return [
                'status' => 'success',
                'data' => $chargesHistoricDB,
                'code' => 200
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
            ];
        }
    }

    public function create($request, $charge_id = null)
    {
        $chargeHistoricRequest = new ChargeHistoricRequest();
        $requestValidated = $chargeHistoricRequest->validate($request);

        if($requestValidated['partner_id']){
            $partnerReturnDB = Partners::query()->findOrFail($requestValidated['partner_id']);
            $requestValidated['name'] = $partnerReturnDB['name'];
        } else {
            $requestValidated['partner_id'] = null;
        }

        $requestValidated['type'] = 'Phone';
        $requestValidated['datetime'] = Carbon::now();
        $requestValidated['charge_id'] = $charge_id;

        try {
            $chargeDB = Charges::query()->with('franchising', 'attendant')->findOrFail($charge_id);
            $chargeDB->update([
                'date_schedule' => $requestValidated['date_schedule']
            ]);

            $chargeHistoricDB = auth()->user()->historicCharge()->create($requestValidated);

            if($chargeHistoricDB['success'] == 'Não'){
                ChargeSchedule::query()->create([
                    'user_id' => $chargeHistoricDB->user_id,
                    'charge_id' => $chargeDB->id,
                    'title' => $chargeDB->franchising->name,
                    'start' => $chargeDB->date_schedule,
                    'backgroundColor' => $chargeDB->attendant->color,
                ]);
            }

            return [
                'status' => 'success',
                'data' => $chargeHistoricDB,
                'code' => 200,
                'message' => 'Histórico cadastrado com sucesso !'
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

    public function sendWhatsapp($request, $charge_id = null)
    {
        $chargeHistoricRequest = new ChargeHistoricRequest();
        $requestValidated = $chargeHistoricRequest->validatePartner($request);
        $mytime = Carbon::now()->format('d/m/Y');

        try {
            $lastProposalActive = Proposals::query()
                ->where('status', 'Ativo')
                ->where('charge_id', $charge_id)
                ->where('partner_id', $requestValidated['partner_id'])
                ->orderBy('created_at', 'DESC')->first();

            $partnerReturnDB = Partners::query()->findOrFail($requestValidated['partner_id'])->toArray();
            $lastChargePartnerByWhatsappReturnDB = $this->getLastCharges($charge_id, 'Whatsapp', $requestValidated['partner_id']);

            if($lastProposalActive == null ) {
                return [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Você Precisa cadastrar uma proposta para esse sócio primeiro.'
                ];
            } elseif ($lastChargePartnerByWhatsappReturnDB != null && $mytime == formatDate($lastChargePartnerByWhatsappReturnDB->created_at) && $lastProposalActive->partner_id == $requestValidated['partner_id']) {
                    return [
                        'status' => 'error',
                        'code' => 400,
                        'message' => 'Você já enviou uma mensagem hoje para para esse sócio tente novamente amanhã, ou tente para outro sócio dessa unidade'
                    ];
                } elseif ($partnerReturnDB['phone'] == null ) {
                return [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'O Sócio selecionado não possuí um telefone.'
                ];
            } else {
                    $sendWhatsappService = new SendWhatsappService();
                    $sendWhatsappServiceReturn = $sendWhatsappService->sendMessage($partnerReturnDB, $lastProposalActive);

                    if ($sendWhatsappServiceReturn->error == false){
                        $addChargeHistoricDB = auth()->user()->historicCharge()->create([
                            'type' => 'WhatsApp',
                            'name' => $partnerReturnDB['name'],
                            'datetime' => Carbon::now(),
                            'charge_id' => $charge_id,
                            'partner_id' => $requestValidated['partner_id'],
                            'success' => 'Sim',
                            'whatsapp' => $partnerReturnDB['phone']
                        ]);
                    } else {
                        $addChargeHistoricDB = auth()->user()->historicCharge()->create([
                            'type' => 'WhatsApp',
                            'name' => $partnerReturnDB['name'],
                            'datetime' => Carbon::now(),
                            'charge_id' => $charge_id,
                            'partner_id' => $requestValidated['partner_id'],
                            'success' => 'Não',
                            'whatsapp' => $partnerReturnDB['phone']
                        ]);
                    }

                    return [
                        'status' => 'success',
                        'data' => $addChargeHistoricDB,
                        'code' => 202,
                        'message' => 'Histórico cadastrado com sucesso !'
                    ];
                }

        } catch (Exception $exception){

            return [
                'status' => 'error',
                'data' => $exception,
                'code' => 200,
                'message' => 'Erro ao Cadastrar'
            ];

        }
    }

    public function sentProposal($id = null)
    {
        $proposalDB = Proposals::query()->with('partner', 'charge.attendant')->findOrFail($id);
        $mytime = Carbon::now()->format('d/m/Y');

        try {

            $lastChargePartnerByEmailReturnDB = $this->getLastCharges($proposalDB['charge_id'],'Email', $proposalDB['partner_id']);

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
            } elseif ($lastChargePartnerByEmailReturnDB != null && $mytime == formatDate($lastChargePartnerByEmailReturnDB->created_at)) {
                return [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Você já enviou uma mensagem hoje para para esse sócio tente novamente amanhã, ou tente para outro sócio dessa unidade'
                ];
            } else {
                $partner = $proposalDB['partner'];
                $sent = $partner->notify( new NotifyChargeFranchising($proposalDB));

                $addChargeHistoricDB = auth()->user()->historicCharge()->create([
                    'type' => 'Email',
                    'name' => $proposalDB['partner']['name'],
                    'datetime' => Carbon::now(),
                    'charge_id' => $proposalDB['charge_id'],
                    'partner_id' => $proposalDB['partner_id'],
                    'success' => 'Não',
                    'email' => $proposalDB['partner']['email']
                ]);

                return [
                    'status' => 'success',
                    'data' => $sent,
                    'code' => 200,
                    'message' => 'Mensagem enviada com sucesso !'
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

    public function getLastCharges($charge_id, $type, $partner_id )
    {
        $lastChargePartnerByTypeReturnDB = ChargeHistoric::query()
            ->where('charge_id', $charge_id)
            ->where('type', $type)
            ->where('partner_id', $partner_id)
            ->orderBy('created_at', 'DESC')->first();

        return $lastChargePartnerByTypeReturnDB;

    }

    public function simulate($request)
    {
        $chargeHistoricRequest = new SimulateRequest();
        $requestValidated = $chargeHistoricRequest->validate($request);

        try {
            $simulateService = new SimulationService();
            $simulateReturnService = $simulateService->simulationAgreement($requestValidated);

            return [
                'status' => 'success',
                'data' => $simulateReturnService,
                'code' => 200,
                'message' => 'Simulação concluida com sucesso !'
            ];

        } catch ( Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao fazer a simulação'
            ];
        }
    }

    public function getChargesBySchedule($filterData = null)
    {
        try {
            $chargeScheduleDB = ChargeSchedule::query()->with('user');

            if(isset($filterData['user_id']) && $filterData['user_id'] != null ) {
                $chargeScheduleDB->whereIn('user_id', $filterData['user_id']);
            }

            $chargeScheduleDB = $chargeScheduleDB->get();

            $return = [];

            foreach ($chargeScheduleDB as $key => $item) {
//                dd($item->user);
                $return[$key]['id'] = $item->id;
                $return[$key]['charge_id'] = $item->charge_id;
                $return[$key]['charge_historic_id'] = $item->charge_historic_id;
                $return[$key]['title' ]= $item->title;
                $return[$key]['start'] = $item->start;
                $return[$key]['user_id'] = $item->user_id;
                $return[$key]['color'] = 'hsl('.$item->user->color.')';

            }

            return $return;

        } catch ( Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao fazer a simulação'
            ];
        }

    }

}

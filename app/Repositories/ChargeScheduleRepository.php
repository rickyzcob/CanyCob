<?php

namespace App\Repositories;

use App\Models\Charges;
use App\Models\ChargeSchedule;
use App\Models\Partners;
use App\Requests\ChargeHistoricRequest;
use Carbon\Carbon;
use PHPUnit\Exception;

class ChargeScheduleRepository
{
    public function show($id)
    {
        try {
            $chargeScheduleDB = ChargeSchedule::query()->with(['charge.franchising', 'historic', 'user'])->where('id', $id)->first();

            return [
                'status' => 'success',
                'data' => $chargeScheduleDB,
                'code' => 200,
            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao buscar o Produto'
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


}

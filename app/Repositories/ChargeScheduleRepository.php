<?php

namespace App\Repositories;

use App\Models\Charges;
use App\Models\ChargeSchedule;
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


}

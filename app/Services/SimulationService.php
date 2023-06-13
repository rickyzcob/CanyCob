<?php

namespace App\Services;
use Carbon;

class SimulationService
{
    public function simulationAgreement($request)
    {
        $simulate = [];

        for($i=1; $i <= $request['installments']; $i++){
            $simulate[$i]['installment'] = $i;
            $simulate[$i]['amount'] = ($request['amount'] - $request['entry']) / $request['installments'];
            $simulate[$i]['due_date']= $i == 1 ? Carbon\Carbon::parse($request['due_date'])->format('Ymd') : Carbon\Carbon::parse($request['due_date'])->subMonth()->addMonths($i)->format('Ymd') ;
        }

        return $simulate;
    }
}

<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;

class SimulateRequest
{
    public function validate($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'amount' => 'required',
            'installments' => 'required|numeric|gte:0|lte:36',
            'due_date' => 'required',
            'entry' => 'required',
        ]);

        return $validator;
    }
}

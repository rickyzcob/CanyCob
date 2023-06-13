<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;

class AgreementRequest
{
    public function validate($request, $id = null)
    {
        $request['inflow'] = formatDecimal($request['inflow']);
        $request['installment_value'] = formatDecimal($request['installment_value']);

        $validator =  Validator::validate($request, [
            'partner_id' => 'required',
            'amount_corrected' => 'required',
            'inflow' => 'sometimes|gte:0|lte:amount_corrected|decimal:2',
            'installment_value' => 'sometimes|gte:0|lte:amount_corrected|decimal:2',
            'installments' => 'required|numeric|gte:0|lte:36',
            'due_date' => 'required'
        ]);

        return $validator;
    }
}

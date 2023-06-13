<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;

class ProposalRequest
{
    public function validate($request, $id = null)
    {
//        $request['inflow'] = formatDecimal($request['inflow']);

        $validator =  Validator::validate($request, [
            'template_proposal_id' => 'required',
            'partner_id' => 'required',
            'amount_corrected' => 'required',
            'inflow' => 'sometimes|gte:0|lte:amount_corrected',
            'installments' => 'required|numeric|gte:0|lte:36',
            'days'=> 'required|numeric|gte:0|lte:10'
        ]);

        return $validator;
    }
}

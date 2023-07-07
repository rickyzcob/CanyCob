<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProposalRequest
{
    public function validate($request, $id = null)
    {
        $request['amount_corrected'] = formatDecimal($request['amount_corrected']);
        $request['inflow'] = formatDecimal($request['inflow']);

//        dd( formatDecimal($request['amount_corrected']));

        $validator =  Validator::validate($request, [
            'type' => 'required',
            'template_proposal_id' => 'required',
            'partner_id' => 'required',
            'amount_corrected' => 'required',
            'inflow' => [
                Rule::requiredIf($request['type'] == 'Parcelado com Entrada'),
                'gte:1',
                'lte:amount_corrected'
            ],
            'installments' => [
                Rule::requiredIf($request['type'] == 'Parcelado com Entrada' || $request['type'] == 'Parcelado sem Entrada'),
                'numeric',
                'gte:1',
                'lte:36'
            ],
            'days'=> 'required|numeric|gte:1|lte:10'
        ]);

        return $validator;
    }

    public function validateProposal($request, $id = null)
    {
        $request['amount_corrected'] = formatDecimal($request['amount_corrected']);

        $validator =  Validator::validate($request, [

            'template_proposal_id' => 'required',
            'partner_id' => 'required',
            'amount_corrected' => 'required',
            'installments' => 'required|numeric|gte:1|lte:36',
            'days'=> 'required|numeric|gte:1|lte:10'
        ]);

        return $validator;
    }


}

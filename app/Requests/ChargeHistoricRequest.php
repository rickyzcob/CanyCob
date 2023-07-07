<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ChargeHistoricRequest
{
    public function validate($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'type' => 'sometimes',
            'name' => 'required_if:type,Unidade',
            'phone' => 'required',
            'partner_id' => 'required_if:type,Sócio',
            'answered' => 'required',
            'success' => 'required',
            'date_schedule' => Rule::requiredIf($request['success'] == 'Não'),
            'date_conference' => Rule::requiredIf($request['success'] == 'Sim'),
            'datetime' => 'sometimes',
            'type' => 'sometimes',
            'description' => 'required',
            'origin' => 'required'
        ]);

        return $validator;
    }

    public function validatePartner($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'partner_id' => 'required',
        ]);

        return $validator;
    }
}

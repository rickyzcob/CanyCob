<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;

class FranchisingRequest
{
    public function validate($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'name' => 'required',
            'razao_social' => 'required',
            'attendant_id' => 'required',
            'supervisor' => 'sometimes|nullable',
            'status' => 'required',
            'cnpj' => 'required',
            'insc' => 'required',
            'cro' => 'sometimes|nullable',
            'resposavel_tecnico' => 'sometimes|nullable',
            'responsavel_tecnico_cro' => 'sometimes|nullable',
            'cep' => 'required',
            'address' => 'required',
            'number' => 'required',
            'complement' => 'sometimes|nullable',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'populacao' => 'sometimes|nullable',
            'phone01' => 'required',
            'phone02' => 'sometimes|nullable',
            'whatsapp' => 'required',
            'site' => 'sometimes|nullable',
            'email_site' => 'sometimes|nullable',
            'email' => 'required',

        ]);

        return $validator;
    }

}

<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;

class ConfigurationRequest
{

    public function validateValues($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'name' => 'required',
            'goals_coins' => 'required',
            'corporate_name' => 'required',
            'state_registration' => 'required',
            'entities_number' => 'required',
            'document' => 'sometimes|nullable',
            'zip_code' => 'required',
            'address' => 'required',
            'number' => 'sometimes',
            'complement' => 'sometimes',
            'neighborhood' => 'required',
            'city' => 'required',
            'uf' => 'required',
            'type_agreement' => 'required'
        ]);

        return $validator;
    }

    public function validateLogo($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'image' => 'sometimes|nullable|image'
        ]);

        return $validator;
    }
    public function validateClickSingValues($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'host' => 'required',
            'token' => 'required',
            'template_document' => 'required',
        ]);

        return $validator;
    }

}

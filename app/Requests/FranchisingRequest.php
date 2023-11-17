<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;

class FranchisingRequest
{
    public function validate($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'name' => 'required',
            'corporate_name' => 'required',
            'attendant_id' => 'required',
            'email' => 'required',
            'employer_number' => 'required',
            'state_registration' => 'sometimes|nullable',
            'zip_code' => 'required',
            'address' => 'required',
            'number' => 'required',
            'complement' => 'sometimes|nullable',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'phone01' => 'required',
            'phone02' => 'sometimes|nullable',
            'whatsapp' => 'sometimes|nullable',
            'site' => 'sometimes|nullable',
            'email_site' => 'sometimes|nullable',
            'status' => 'required',

        ]);
        return $validator;
    }

}

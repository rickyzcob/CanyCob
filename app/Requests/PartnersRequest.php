<?php

namespace App\Requests;

use App\Rules\TenantTenantUnique;
use Illuminate\Support\Facades\Validator;

class PartnersRequest
{
    public function validate($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'cpf' => 'required',
            'image' => 'sometime|nullable'

        ]);

        return $validator;
    }
}

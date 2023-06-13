<?php

namespace App\Requests;

use App\Rules\TenantTenantUnique;
use Illuminate\Support\Facades\Validator;

class RoleRequest
{
    public function validate($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'guard_name',
            'name' =>  'required'
        ]);

        return $validator;
    }
}

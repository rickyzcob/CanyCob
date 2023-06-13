<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;

class ChargeStatusRequest
{
    public function validate($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'name' => 'required',
            'color' => 'required',
            'status' => 'required',
        ]);

        return $validator;
    }

}

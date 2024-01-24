<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;

class PaymentMethodRequest
{
    public function validate($request, $id = null)
    {

        $validator =  Validator::validate($request, [
            'type' => 'required',
            'code' => 'required',
            'bank' => 'required',
            'agency' =>  'required',
            'count' => 'required',
            'bill' => 'sometimes|nullable',
            'status' => 'required',
        ]);

        return $validator;
    }

}

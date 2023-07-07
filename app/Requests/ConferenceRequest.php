<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;

class ConferenceRequest
{
    public function validate($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'payment_code' =>  'required'
        ]);

        return $validator;
    }
}

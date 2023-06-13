<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;

class ContactsFranchisingRequest
{
    public function validate($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'status' => 'required'
        ]);

        return $validator;
    }

}

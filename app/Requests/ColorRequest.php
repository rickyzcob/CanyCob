<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;

class ColorRequest
{
    public function validate($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'color' =>  'required'
        ]);

        return $validator;
    }

}

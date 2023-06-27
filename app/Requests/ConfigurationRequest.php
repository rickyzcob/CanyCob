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

}

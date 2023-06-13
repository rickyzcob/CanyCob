<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;

class FeesRequest
{
    public function validate($request, $id = null)
    {

        $request['value'] = str_replace(',', '.', $request['value']);

        $validator =  Validator::validate($request, [
            'name' => 'required',
            'value' => 'required|decimal:2',
            'type' => 'required',
            'status' => 'required',
            'automatic' => 'required'
        ]);

        return $validator;
    }
}

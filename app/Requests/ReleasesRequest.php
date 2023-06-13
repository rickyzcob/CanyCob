<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;

class ReleasesRequest
{
    public function validatePrecification($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'fees_year' => 'required',
            'fees_month' => 'required',
        ]);

        return $validator;
    }

}

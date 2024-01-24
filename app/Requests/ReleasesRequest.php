<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;

class ReleasesRequest
{
    public function validate($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'type_release_id' => 'sometimes',
            'type' => 'required',
            'due_date' => 'required'
        ]);

        return $validator;
    }
    public function validatePrecification($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'fees_year' => 'required',
            'fees_month' => 'required',
        ]);

        return $validator;
    }

}

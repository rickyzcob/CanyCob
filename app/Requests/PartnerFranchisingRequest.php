<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;

class PartnerFranchisingRequest
{

    public function validate($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'partner_id' => 'required',
            'franchising_id' => 'sometimes'
        ]);

        return $validator;
    }
}

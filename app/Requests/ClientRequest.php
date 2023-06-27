<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ClientRequest
{
    public function validate($request, $id = null)
    {

//        dd($request);

        $validator =  Validator::validate($request, [
            'name' => 'required',
            'status' => 'required',
            'subdomain' => 'required',
            'scope' => 'sometimes',

            'user.name' => 'required',
            'user.status' => 'required',

            'user.email' => [
                'required',
                'email:rfc,dns',
                "unique :users,email,{$id},id"
            ],
            'user.phone' => 'required',
            'user.document' => 'required',
            'user.password' => [
                Rule::excludeIf(fn () => $id != null),
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'confirmed'
            ],
        ]);

        return $validator;
    }
}

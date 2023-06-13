<?php

namespace App\Requests;

use App\Rules\TenantTenantUnique;
use App\Rules\ValidCurrentUserPassword;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest
{
    public function validate($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'name' => 'required',
            'status' => 'required',
            'type' => 'required',
            'role_id' =>' required',
            'email' => [
                'required',
                'email:rfc,dns',
                "unique :users,email,{$id},id"
            ],
            'phone' => 'required',
            'document' => 'required',
            'password' => [
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

    public function validateProfile($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                'email:rfc,dns',
                "unique :users,email,{$id},id"
            ],
            'phone' => 'required',
            'document' => 'required',
        ]);

        return $validator;
    }

    public function validatePassword($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'confirmed',
                new ValidCurrentUserPassword()
            ],
        ]);

        return $validator;
    }
    public function validateImage($request, $id = null)
    {
        $validator =  Validator::validate($request, [
            'image' => 'sometimes|nullable|image'
        ]);

        return $validator;
    }


}

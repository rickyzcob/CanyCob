<?php

namespace App\Repositories;

use App\Models\ClickSign;
use App\Requests\ConfigurationRequest;

class ClickSignRepository
{
    public function getClickSing()
    {
        return ClickSign::query()->first();

    }

    public function update($request, $id = null)
    {

        $userRequest = new ConfigurationRequest();
        $requestValidated = $userRequest->validateClickSingValues($request);

        try {
            $clicksignDB = ClickSign::query()->find($id);

            $clicksignDB->update($requestValidated);
            $clicksignDB->fresh();

            return [
                'status' => 'success',
                'data' => $clicksignDB,
                'code' => 200,
                'message' => 'Dados atualizado com sucesso !'
            ];

        }catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao Atualizar'
            ];
        }
    }

    public function create($request)
    {

        $userRequest = new ConfigurationRequest();
        $requestValidated = $userRequest->validateClickSingValues($request);

        try {

            $clicksignDB = ClickSign::query()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $clicksignDB,
                'code' => 200,
                'message' => 'Dados atualizado com sucesso !'
            ];

        }catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao Atualizar'
            ];
        }
    }

}

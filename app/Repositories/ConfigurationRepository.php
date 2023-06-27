<?php

namespace App\Repositories;

use App\Models\Configurations;
use App\Models\Tenant;
use App\Requests\ConfigurationRequest;
use App\Services\ChangeColorsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use MongoDB\Driver\Session;

class ConfigurationRepository
{

    public function getConfiguration()
    {
        return Tenant::query()->findOrFail(Auth::user()->tenant->id);
    }

    public function updateConfigurationData($request)
    {
        $userRequest = new ConfigurationRequest();
        $requestValidated = $userRequest->validateValues($request);

        try {
            $configurationDB = $this->getConfiguration();

            $configurationDB->update($requestValidated);
            $configurationDB->fresh();

            \Illuminate\Support\Facades\Session::put('tenant', $configurationDB->only('name', 'subdomain', 'color', 'text_color', 'scope', 'logo'));

            return [
                'status' => 'success',
                'data' => $configurationDB,
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

    public function uploadLogo($logo)
    {

        try {
            $configurationDB = $this->getConfiguration();

            if(isset($logo) && $logo != $configurationDB->logo){
                if(Storage::exists('public/'.$configurationDB->logo)) {
                    Storage::delete('public/'.$configurationDB->logo);
                }
                $requestValidated['logo'] = $logo->store('logo/image', 'public');
            } else {
                $requestValidated['logo'] = $configurationDB->logo;
            }


            $configurationDB->update($requestValidated);
            $configurationDB->fresh();

            \Illuminate\Support\Facades\Session::put('tenant', $configurationDB->only('name', 'subdomain', 'color', 'text_color', 'scope', 'logo'));

            return [
                'status' => 'success',
                'data' => $configurationDB,
                'code' => 200,
                'message' => 'Logo Atualizado com sucesso !'
            ];

        }catch (\Exception $exception) {

            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao Atualizar'
            ];
        }
    }

    public function changeColor($color)
    {

        $changeColorService = new ChangeColorsService();

        $bgcolor = $changeColorService->hexToHsl($color);
        $textColor = $changeColorService->changeTextColor($bgcolor);

        try {
            $configurationDB = $this->getConfiguration();

            $configurationDB->update([
                'color' => $bgcolor,
                'text_color' => $textColor

            ]);
            $configurationDB->fresh();

            \Illuminate\Support\Facades\Session::put('tenant', $configurationDB->only('name', 'subdomain', 'color', 'text_color', 'scope', 'logo'));

            return [
                'status' => 'success',
                'data' => $configurationDB,
                'code' => 200,
                'message' => 'Cores alteradas com sucesso !'
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

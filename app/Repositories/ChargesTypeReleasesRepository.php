<?php

namespace App\Repositories;

use App\Models\ChargeAmountReleases;
use PHPUnit\Exception;

class ChargesTypeReleasesRepository
{
    public function getTypeReleasesByCharge($charge_id = null)
    {
        try {
            $typeReleasesDB = ChargeAmountReleases::query()->with('typeRelease')->where('charge_id', $charge_id)->get();

            return [
                'status' => 'success',
                'data' => $typeReleasesDB,
                'code' => 200,
            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na requisição'
            ];
        }
    }

    public function show($id = null)
    {
        try {
            $typeReleasesDB = ChargeAmountReleases::query()->with(['charge', 'typeRelease'])->findOrFail($id);

            return [
                'status' => 'success',
                'data' => $typeReleasesDB,
                'code' => 200,
            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na requisição'
            ];
        }
    }

}

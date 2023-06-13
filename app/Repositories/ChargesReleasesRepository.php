<?php

namespace App\Repositories;

use App\Models\Releases;
use PHPUnit\Exception;

class ChargesReleasesRepository
{
    public function index($id)
    {
        try {
            $releasesDB = Releases::query()->where('franchising_id', $id)->where('status_id', 3)->orderBy('created_at', 'DESC')->get();

            return [
                'status' => 'success',
                'data' => $releasesDB,
                'code' => 200
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao Cadastrar'
            ];
        }

    }

    public function getReleasesForCharge($id)
    {
        try {
            $releasesDB = Releases::query()->with('status')
                ->where('charge_id', $id)
                ->orderBy('created_at', 'DESC')
                ->get();

            return [
                'status' => 'success',
                'data' => $releasesDB,
                'code' => 200
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao Cadastrar'
            ];
        }

    }
}

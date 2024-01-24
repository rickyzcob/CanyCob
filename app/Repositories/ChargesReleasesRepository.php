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

    public function getReleasesForCharge($id, $pageSize)
    {
        try {
            $releasesDB = Releases::query()->with(['status', 'typeRelease'])
                ->whereType(null)
                ->where('charge_id', $id)
                ->orderBy('created_at', 'DESC');

             if($pageSize) {
                 $releasesDB = $releasesDB->paginate($pageSize);
             } else {
                 $releasesDB = $releasesDB->get();
             }

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


    public function getReleasesForTypeAmount($charge_amount_release_id, $pageSize = null)
    {

        try {
            $releasesDB = Releases::query()->with(['status', 'typeRelease'])
                ->where('charge_amount_release_id', $charge_amount_release_id)
                ->orderBy('created_at', 'DESC');

            if($pageSize) {
                $releasesDB = $releasesDB->paginate($pageSize);
            } else {
                $releasesDB = $releasesDB->get();
            }

            return [
                'status' => 'success',
                'data' => $releasesDB,
                'code' => 200
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na requisição'
            ];
        }
    }
}

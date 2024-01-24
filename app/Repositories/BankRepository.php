<?php

namespace App\Repositories;

use App\Models\Banks;
use PHPUnit\Exception;

class BankRepository
{
    public function getBankByCode($code)
    {
        try {
            $banksDB = Banks::query()->where('code', $code)->first();

            if($banksDB != null) {
                return [
                    'status' => 'success',
                    'data' => $banksDB,
                    'message' => 'Banco obtido com sucesso !'
                ];
            } else {
                return [
                    'status' => 'error',
                    'data' => $banksDB,
                    'message' => 'Banco não encontrado.'
                ];
            }

        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na requisição'
            ];
        }
    }
}

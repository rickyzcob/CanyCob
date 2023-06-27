<?php

namespace App\Repositories;

use App\Models\User;
use PHPUnit\Exception;

class HumorRepository
{
    public function getUsersByCoin()
    {
        try {
            $usersDB = User::query()->whereStatus('Ativo')->whereType('Colaborador')
                ->orderBy('coins', 'DESC')->take(10)->get();

            return [
                'status' => 'success',
                'data' => $usersDB,
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

<?php

namespace App\Repositories;

use App\Models\Coins;
use App\Models\Fees;
use App\Models\User;
use App\Requests\FeesRequest;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;

class CoinsRepository
{
    public function create($request)
    {
        $request['type'] = 'Humor';

        if(isset($request['description'] ) && $request['description'] != null){
            $request['coins'] = 50;
        } else {
            $request['coins'] = 25;
        }

        try {


            $coinsDB = auth()->user()->coins()->create($request);
            $this->addCoinsToUser($coinsDB->coins);

            return [
                'status' => 'success',
                'data' => $coinsDB,
                'code' => 200,
                'message' => 'Obrigado por compartilhar seu status conosco !!'
            ];
        } catch (Exception $exception){

            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao Cadastrar'
            ];

        }
    }
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

    public function getLastCoinByHumor()
    {
        $today = date('Y-m-d');

        try {
            $coinsDB = Coins::query()->where('user_id', Auth::user()->id)
                ->where('type', 'Humor')->latest()->first();

            if( $coinsDB == null || $today != $coinsDB->created_at->format('Y-m-d') ){;
                return true;
            } elseif($today == $coinsDB->created_at->format('Y-m-d') ) {
                return false;
            }

        } catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro na requisição'
            ];
        }

    }

    public function addCoinsToUser($coins)
    {
        $userDB = User::query()->findOrFail(auth()->user()->id);

        $userDB->increment('coins', $coins);

    }
}

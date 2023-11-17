<?php

namespace App\Repositories;

use App\Models\Coins;
use App\Models\HistoricMonthCoins;
use App\Models\Partners;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;

class CoinsRepository
{

    public function index($filterData = null, $pageSize, $orderBy)
    {

        try {
            $userDB = User::query()->whereStatus('Ativo')->whereType('Colaborador')
                ->orderBy('coins', 'DESC');

            if (isset($filterData['name']) && $filterData['name'] != null) {
                $userDB->where('name', 'like', '%'.$filterData['name'].'%');
            }
            if (isset($filterData['email']) && $filterData['email'] != null) {
                $userDB->where('email', 'like', '%'.$filterData['email'].'%');
            }
            if (isset($filterData['cpf']) && $filterData['cpf'] != null) {
                $userDB->where('cpf', 'like', '%'.$filterData['cpf'].'%');
            }

            $userDB->orderBy($orderBy['column'], $orderBy['order']);

            $userDB = $userDB->paginate($pageSize);

            return [
                'status' => 'success',
                'data' => $userDB,
                'code' => 200
            ];
        } catch (\PharIo\Version\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na Requisição'
            ];
        }
    }

    public function create($request, $type, $user_id)
    {
        if($type == 'Humor') {
            $request['type'] = $type;
            if(isset($request['description'] ) && $request['description'] != null){
                $request['coins'] = 50;
            } else {
                $request['coins'] = 25;
            }
        } else if ($type == 'Cobrança') {
            $request['type'] = $type;
            $request['coins'] = 100;
            $request['description'] ;
        } else if ($type == 'Acordo') {
            $request['type'] = $type;
            $request['coins'] = 200;
            $request['description'] ;
        }

        try {

            $coinsDB = auth()->user()->coins()->create($request);
            $this->addCoinsToUser($user_id, $coinsDB->coins);

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

    public function show($id)
    {
        try {
            $coinsDB = Coins::query()->with('user')->find($id);

            return [
                'status' => 'success',
                'data' => $coinsDB,
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
                'message' => 'Erro na Requisição'
            ];
        }
    }

    public function getHistoricMonthlyCoinsByUser($user_id = null, $pageSize = null)
    {
        $month = date('m');

        try {
            $usersDB = Coins::query()->where('user_id', $user_id)->whereMonth('created_at', $month);
            $usersDB = $usersDB->orderBy('created_at', 'DESC');

            if($pageSize) {
                $usersDB = $usersDB->paginate($pageSize);
            } else {
                $usersDB = $usersDB->get();
            }


            return [
                'status' => 'success',
                'data' => $usersDB,
                'code' => 200
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na Requisição'
            ];
        }
    }

    public function reseMonthCoins()
    {
        $lastDay = Carbon::now()->endOfMonth();
        $day = date('d');
        $date = date('d-m-Y');

        try {
            $usersDB = User::query()->whereStatus('Ativo')->whereType('Colaborador');
            $usersDB = $usersDB->orderBy('created_at', 'DESC');
            $usersDB = $usersDB->get();

            if($day == $lastDay->day )  {

                foreach ($usersDB as $itemUser) {
                    HistoricMonthCoins::query()->create([
                        'user_id' => $itemUser->id,
                        'coins' => $itemUser->coins,
                        'date' => $date
                    ]);
                    $itemUser->coins = 0 ;
                    $itemUser->update();
                }

                return [
                    'status' => 'success',
                    'data' => $usersDB,
                    'message' => 'Pontuação resetada com sucesso',
                    'code' => 200
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Voce precisa estar no último dia útil do mês para resetar a pontuação',
                    'code' => 400
                ];
            }


        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na Requisição'
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
                'code' => 400,
                'message' => 'Erro na requisição'
            ];
        }
    }

    public function addCoinsToUser($user_id, $coins)
    {
        $userDB = User::query()->findOrFail($user_id);

        $userDB->increment('coins', $coins);

    }

    public function getHumorByUserDaily()
    {
        $today = date('Y-m-d');

        try {
            $coinsDB = Coins::query()->with('user')->where('type', 'Humor')->whereDate('created_at', $today)->get();

//            $coinsDB->whereHas('user', function ($query) {
//                $query->where('tenant_id', Auth::user()->tenant->id)->orderBy('created_at', 'DESC');
//            });

            return [
                'status' => 'success',
                'data' => $coinsDB,
                'code' => 200
            ];

        } catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na requisição'
            ];
        }
    }
}

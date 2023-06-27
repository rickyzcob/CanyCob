<?php

namespace App\Repositories;

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use App\Requests\AuthRequest;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PHPUnit\Exception;


class AuthRepository
{
    public function login($request)
    {
        $authRequest = new AuthRequest();
        $requestValidated = $authRequest->validate($request);

        $user = User::query()->where('email', '=', $requestValidated['email'])->whereStatus('Ativo')
            ->first();

        if ($user && Auth::attempt(['email' => $user['email'], 'password' => $requestValidated['password']])) {
            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'Login efetuado com suceso, Seja Bem Vindo'
            ];
        } else {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Usuários e senha inválidos'
            ];
        }
    }

    public function passwordRecovery($request)
    {

        $authRequest = new AuthRequest();
        $requestValidated = $authRequest->validateEmail($request);

        $user = User::query()->where('email', '=', $requestValidated['email'])->whereStatus('Ativo')
            ->first();

        if(!$user){
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Usuáro Inativo ou Inexistente'
            ];
        }

        try {
            $tokenData = DB::table('password_resets')
                ->where('email', $user['email'])->first();

            if($tokenData){
                return [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Voce já fez uma requisição para alterar a senha por favor veja em seu email as instruções para alterar a sua senha.'
                ];
            } else {
                DB::table('password_resets')->insert([
                    'email' => $requestValidated['email'],
                    'token' => Str::random(60),
                    'created_at' => Carbon::now()
                ]);
            }

            //Get the token just created above
            $tokenData = DB::table('password_resets')
                ->where('email', $requestValidated['email'])->first();

            if ($this->sendResetEmail($requestValidated['email'], $tokenData->token)) {
                return [
                    'status' => 'success',
                    'code' => 504,
                    'message' => 'Senha Enviada com sucesso, por favor veja seu email as instruções para cadastrar uma nova senha'
                ];
            }
        }catch (\PHPUnit\Util\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Houve um erro no sistema, por favor tente novamente.'
            ];
        }
    }

    public function changePassword($request)
    {
        $authRequest = new AuthRequest();
        $requestValidated = $authRequest->validatePassword($request);

        $tokenData = DB::table('password_resets')
            ->where('token', $requestValidated['token'])->first();

        if (!$tokenData) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Voce nao fez requisição para mudar a senha ou o seu token expirou preencha seu email abaixo'
            ];
        }

        $user = User::where('email', $tokenData->email)->first();

        if (!$user){
            return [
                'status' => 'error',
                'code' => 504,
                'message' => 'Email não encontrado, por favor refaça sua requisição de nova senha com um email válido.'
            ];
        }


        try{
            $user->password = $requestValidated['password'];
            $user->update(); //or $user->save();

            Auth::login($user);

            DB::table('password_resets')->where('email', $user->email)
                ->delete();

            return [
                'status' => 'success',
                'code' => 504,
                'message' => 'Senha Alterada com sucesso por favor faça o seu login'
            ];

        }catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Houve um erro no sistema, por favor tente novamente.'
            ];
        }
    }

    private function sendResetEmail($email, $token)
    {
        $user = User::query()->where('email', $email)->first();
        $link = route('password.reset') . '?token=' . $token . '&email=' . urlencode($user->email);

        try {
            $user->notify(new ResetPasswordNotification($link));
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}

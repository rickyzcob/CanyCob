<?php

namespace App\Http\Livewire\Vendor\Auth;

use App\Repositories\AuthRepository;
use Livewire\Component;

class Login extends Component
{

    public $state = [];
    public $error= '';

    public function submit()
    {
        $request = $this->state;

        $authRepository = new AuthRepository();
        $userReturnDB = $authRepository->login($request);

        if($userReturnDB['status'] == 'success') {
            return $this->redirectRoute('dashboard.index', session('tenant')['subdomain']);
        } else if ($userReturnDB['status'] == 'error') {
            return $this->error =  $userReturnDB['message'];
        }
    }

    public function render()
    {
        return view('livewire.vendor.auth.login');
    }
}

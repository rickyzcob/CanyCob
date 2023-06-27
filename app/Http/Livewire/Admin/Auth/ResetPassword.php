<?php

namespace App\Http\Livewire\Tenant\Auth;

use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Livewire\Component;
use WireUi\Traits\Actions;

class ResetPassword extends Component
{
    use Actions;

    public $state = [];

    public function mount(Request $request)
    {
        if ($request){
            $this->state['email'] = $request->email;
            $this->state['token'] = $request->token;
        }
    }

    public function submit()
    {
        $request = $this->state;

        $authRepository = new AuthRepository();
        $authReturnDB = $authRepository->changePassword($request);

        if($authReturnDB['status'] == 'success') {
            return redirect()->route('login')->with($authReturnDB['status'], $authReturnDB['message']);
        } else if ($authReturnDB['status'] == 'error') {
            return redirect()->route('password.request')->with($authReturnDB['status'], $authReturnDB['message']);
        }

    }
    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}

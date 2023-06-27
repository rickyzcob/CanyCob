<?php

namespace App\Http\Livewire\Vendor\Auth;

use App\Repositories\AuthRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Recovery extends Component
{
    use Actions;

    public $state = [];
    public $sent = false;

    public function submit()
    {
        $request = $this->state;
        $authRepository = new AuthRepository();
        $authReturnDB = $authRepository->passwordRecovery($request);

        if($authReturnDB['status'] == 'success') {
            $this->sent = true;
        } else if ($authReturnDB['status'] == 'error') {
            return redirect()->route('password.request')->with($authReturnDB['status'], $authReturnDB['message']);
        }
    }

    public function render()
    {
        return view('livewire.vendor.auth.recovery');
    }
}

<?php

namespace App\Http\Livewire\Vendor\Users;

use App\Http\Traits\WithModal;
use App\Repositories\UsersIndicationsRepository;
use Livewire\Component;

class Indicators03 extends Component
{
    use WithModal;

    public $user_id;

    public function mount($id = null)
    {
        if($id) {
            $this->user_id = $id;
        }
    }

    public function getUsersByIndications()
    {
        $usersIndicationsRepository = new UsersIndicationsRepository();
        return $usersIndicationsRepository->show($this->user_id);
    }


    public function render()
    {
        $response = new \stdClass();
        $response->users = $this->getUsersByIndications();

        return view('livewire.vendor.users.indicators03', ['response' => $response]);
    }
}

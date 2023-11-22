<?php

namespace App\Http\Livewire\Tenant\Schedule;

use App\Repositories\UserRepository;
use Livewire\Component;

class Filter extends Component
{
    public $state = [
        'user_id' => []
    ];
    public function updatedState()
    {
        $request = $this->state;
        $this->emit('filterCardSchedule', $request);
    }
    public function getUsers()
    {
        $usersRepository = new UserRepository();
        return $usersRepository->getSelectAttendantsActive()['data'];

    }
    public function render()
    {
        $response = new \stdClass();
        $response->users = $this->getUsers();

        return view('livewire.tenant.schedule.filter', ['response' => $response]);
    }
}

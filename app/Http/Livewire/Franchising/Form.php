<?php

namespace App\Http\Livewire\Franchising;

use App\Repositories\FranchisingRepository;
use App\Repositories\UserRepository;
use Livewire\Component;

class Form extends Component
{
    public $state = [
        'attendant_id' => ''
    ];
    public $franchising;

    public function mount($id = null)
    {
        $franchisingRepository = new FranchisingRepository();
        $feesReturnDB = $franchisingRepository->show($id)['data'];
        $this->franchising = $feesReturnDB;

        if($this->franchising){
            $this->state = $this->franchising->toArray();
        }
    }

    public function getSelectAttendant()
    {
        $userRepository = new UserRepository();
        $userReturnDB = $userRepository->getSelectAttendantsActive()['data'];
        return $userReturnDB;
    }


    public function render()
    {
        $response = new \stdClass();
        $response->attendants = $this->getSelectAttendant();

        return view('livewire.franchising.form', ['response' => $response]);
    }
}

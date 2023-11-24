<?php

namespace App\Http\Livewire\Tenant\Schedule;

use App\Models\Event;
use App\Repositories\ChargesHistoricsRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Card extends Component
{

    public $events;
    public $filters;

    protected $listeners = [
        'refreshCardSchedule' => '$refresh',
        'filterCardSchedule'
    ];

    public function mount()
    {
        $this->events = json_encode($this->getScheduleCharges());
    }

    public function filterCardSchedule($filterData = null)
    {
        $this->filters = $filterData;
    }

    public function getScheduleCharges($users = null)
    {
        $chargesHistoricRepository = new ChargesHistoricsRepository();
        $chargesHistoricReturnDB = $chargesHistoricRepository->getChargesBySchedule($this->filters);

        if($this->filters != null) {
            $this->dispatchBrowserEvent('schedule-updated', ['filter' =>  $chargesHistoricReturnDB]);
            $this->emit('refreshCalendar');
        }

        return $chargesHistoricReturnDB;

    }
    public function render()
    {
        $response = new \stdClass();
        $response->schedule = json_encode($this->getScheduleCharges());

        return view('livewire.tenant.schedule.card', ['response' => $response]);
    }
}

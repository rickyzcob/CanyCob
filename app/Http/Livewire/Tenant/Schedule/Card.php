<?php

namespace App\Http\Livewire\Tenant\Schedule;

use App\Models\Event;
use App\Repositories\ChargesHistoricsRepository;
use Livewire\Component;

class Card extends Component
{
    public $events = '';

    public function getevent()
    {
        $events = Event::select('id','title','start')->get();

        return  json_encode($events);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addevent($event)
    {
        $input['title'] = $event['title'];
        $input['start'] = $event['start'];
        Event::create($input);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function eventDrop($event, $oldEvent)
    {
        $eventdata = Event::find($event['id']);
        $eventdata->start = $event['start'];
        $eventdata->save();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */

    public function getSheduleChartes()
    {
        $chargesHistoricRepository = new ChargesHistoricsRepository();
        $chargesHistoricReturnDB = $chargesHistoricRepository->getChargesBySchedule();

        return $chargesHistoricReturnDB;

    }
    public function render()
    {

        $response = new \stdClass();
        $response->schedule = json_encode($this->getSheduleChartes());
        $events = Event::select('id','title','start')->get();

        $this->events = json_encode($this->getSheduleChartes());

        return view('livewire.tenant.schedule.card', ['response' => $response]);
    }
}

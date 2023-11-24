<?php

namespace App\Http\Livewire\Tenant\Schedule;

use App\Repositories\ChargesHistoricsRepository;
use Livewire\Component;

class Search extends Component
{
    public $state = [
        'date_start' => '',
        'date_end' => ''
    ];
    public function submit()
    {
        $validatedData = $this->validate([
            'state.name' => 'nullable|sometimes',
            'state.date_start' => 'required_with:state.date_end|',
            'state.date_end' => 'required_with:state.date_start|after_or_equal:state.date_start',
        ]);

        $this->emit('filterCardSchedule', $validatedData['state']);
    }

    public function clearFilter()
    {
        $this->reset();
        $chargesHistoricRepository = new ChargesHistoricsRepository();
        $chargesHistoricReturnDB = $chargesHistoricRepository->getChargesBySchedule();

        $this->emit('filterCardSchedule', $request = null);
        $this->dispatchBrowserEvent('schedule-updated', ['filter' =>  $chargesHistoricReturnDB]);
    }
    public function render()
    {
        return view('livewire.tenant.schedule.search');
    }
}

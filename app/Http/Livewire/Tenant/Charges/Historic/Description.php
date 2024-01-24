<?php

namespace App\Http\Livewire\Tenant\Charges\Historic;

use App\Repositories\ChargesHistoricsRepository;
use App\Repositories\CoinsRepository;
use Livewire\Component;

class Description extends Component
{
    public $historic;

    public function mount($id = null)
    {
        if($id){
            $chargeHistoricRepository = new ChargesHistoricsRepository();
            $chargeHistoricReturnDB = $chargeHistoricRepository->show($id)['data'];
            $this->historic = $chargeHistoricReturnDB;
        }
    }
    public function render()
    {
        return view('livewire.tenant.charges.historic.description');
    }
}

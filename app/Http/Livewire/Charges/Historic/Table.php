<?php

namespace App\Http\Livewire\Charges\Historic;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesFranchisingRepository;
use App\Repositories\ChargesHistoricsRepository;

use App\Repositories\FranchisingRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Table extends Component
{
    use WithModal, Actions;

    protected $listeners = [
        'refreshTableChargeHistoric' => '$refresh',
    ];

    public $franchising;

    public function mount($reference = null, $charge_id = null)
    {
        $chargeFranchisingRepository = new ChargesFranchisingRepository();
        if($reference){
            $chargeFranchisingReturnDB = $chargeFranchisingRepository->showByReference($reference)['data'];
        } elseif ($charge_id){
            $chargeFranchisingReturnDB = $chargeFranchisingRepository->show($charge_id)['data'];
        }
        $this->charge = $chargeFranchisingReturnDB;
    }

    public function getHistoricCharges()
    {
        $franchisingRepository = new ChargesHistoricsRepository();
        $franchisingReturnDB = $franchisingRepository->index($this->charge['id'])['data'];

        return $franchisingReturnDB;
    }

    public function render()
    {
        $response = new \stdClass();
        $response->historicReleases = $this->getHistoricCharges();

        return view('livewire.charges.historic.table', ['response' => $response]);
    }
}

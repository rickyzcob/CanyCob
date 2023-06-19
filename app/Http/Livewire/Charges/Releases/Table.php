<?php

namespace App\Http\Livewire\Charges\Releases;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesFranchisingRepository;
use App\Repositories\ChargesReleasesRepository;
use App\Repositories\FranchisingRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Table extends Component
{
    use WithModal, Actions;

    public $charge;
    public $pageSize = 10;

    protected $listeners = [
        'refreshTableChargesReleases' => '$refresh',
    ];

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
    public function getChargesFranchising()
    {
        $franchisingRepository = new ChargesReleasesRepository();
        $franchisingReturnDB = $franchisingRepository->getReleasesForCharge($this->charge->id, $this->pageSize,)['data'];

        return $franchisingReturnDB;
    }

    public function render()
    {
        $response = new \stdClass();
        $response->releases = $this->getChargesFranchising();

        return view('livewire.charges.releases.table', ['response' => $response]);
    }
}

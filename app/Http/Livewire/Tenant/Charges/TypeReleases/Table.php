<?php

namespace App\Http\Livewire\Tenant\Charges\TypeReleases;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesFranchisingRepository;
use App\Repositories\ChargesTypeReleasesRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Table extends Component
{
    use WithModal, Actions;

    public $charge;

    protected $listeners = [
        'refreshCardTypeReleases' => '$refresh',
    ];

    public function mount($reference = null)
    {
        if ($reference){
            $chargeFranchisingRepository = new ChargesFranchisingRepository();
            $chargeFranchisingReturnDB = $chargeFranchisingRepository->showByReference($reference)['data'];

            $this->charge = $chargeFranchisingReturnDB;
        }
    }
    public function getTypeReleases()
    {
        $chargeTypeReleasesRepository = new ChargesTypeReleasesRepository();
        $chargeTypeReleasesReturnDB = $chargeTypeReleasesRepository->getTypeReleasesByCharge($this->charge['id'])['data'];

        return $chargeTypeReleasesReturnDB;
    }


    public function render()
    {
        $response = new \stdClass();
        $response->typeReleases = $this->getTypeReleases();

        return view('livewire.tenant.charges.type-releases.table', ['response' => $response]);
    }
}

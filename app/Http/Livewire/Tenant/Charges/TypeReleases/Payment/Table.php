<?php

namespace App\Http\Livewire\Tenant\Charges\TypeReleases\Payment;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesReleasesRepository;
use App\Repositories\ChargesTypeReleasesRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Table extends Component
{
    use Actions, WithModal;

    public $typeRelease;
    public $pageSize = 10;

    protected $listeners = [
        'refreshCardPayments' => '$refresh',
    ];

    public function mount($id = null)
    {
        if($id) {
            $chargeTypeReleasesRepository = new ChargesTypeReleasesRepository();
            $chargeFranchisingReturnDB = $chargeTypeReleasesRepository->show($id)['data'];
            $this->typeRelease = $chargeFranchisingReturnDB;
        }
    }

    public function getChargesFranchising()
    {
        $franchisingRepository = new ChargesReleasesRepository();
        $franchisingReturnDB = $franchisingRepository->getReleasesForTypeAmount($this->typeRelease->id, $this->pageSize)['data'];

        return $franchisingReturnDB;
    }

    public function render()
    {
        $response = new \stdClass();
        $response->releases = $this->getChargesFranchising();

        return view('livewire.tenant.charges.type-releases.payment.table', ['response' => $response]);
    }
}

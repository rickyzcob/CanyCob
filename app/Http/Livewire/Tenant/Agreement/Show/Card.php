<?php

namespace App\Http\Livewire\Tenant\Agreement\Show;

use App\Repositories\AgreementRepository;
use App\Repositories\ChargesReleasesRepository;
use Livewire\Component;
use WGenial\NumeroPorExtenso\NumeroPorExtenso;

class Card extends Component
{
    public $agreement;

    public function mount($reference = null)
    {
        if ($reference){
            $this->reference = $reference;

            $franchisingRepository = new AgreementRepository();
            $this->agreement = $franchisingRepository->showByReference($this->reference)['data'];
        }
    }

    public function getChargesFranchising()
    {
        $franchisingRepository = new ChargesReleasesRepository();
        $franchisingReturnDB = $franchisingRepository->getReleasesForCharge($this->agreement['charge_id'], 10)['data'];

        return $franchisingReturnDB;
    }

    public function render()
    {
        $extenso = new NumeroPorExtenso;
        $releases = $this->getChargesFranchising();

        return view('livewire.tenant.agreement.show.card', compact('extenso', 'releases'));
    }
}

<?php

namespace App\Http\Livewire\Charges\Details\Franchising;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesFranchisingRepository;
use App\Repositories\ChargesReleasesRepository;
use App\Repositories\FranchisingRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Card extends Component
{
    use Actions, WithModal;

    public $franchising;
    public $charge;

    protected $listeners = [
        'refreshCardFranchising' => '$refresh',
    ];

    public function mount($reference = null)
    {
        if ($reference){
            $chargeFranchisingRepository = new ChargesFranchisingRepository();
            $chargeFranchisingReturnDB = $chargeFranchisingRepository->showByReference($reference)['data'];
//            dd($chargeFranchisingReturnDB);
            $this->charge = $chargeFranchisingReturnDB;

            $franchisingRepository = new FranchisingRepository();
            $franchisingReturnDB = $franchisingRepository->show($chargeFranchisingReturnDB['franchising_id'])['data'];

            $this->franchising = $franchisingReturnDB;
        }

    }

    public function render()
    {
        return view('livewire.charges.details.franchising.card');
    }
}

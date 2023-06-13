<?php

namespace App\Http\Livewire\Charges\Top;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesFranchisingRepository;
use App\Repositories\ChargeStatusRepository;

use Livewire\Component;
use WireUi\Traits\Actions;

class Card extends Component
{
    use Actions, WithModal;

    public $reference;
    public $charge;

    protected $listeners = ['refreshCardTop' => '$refresh'];

    public function mount($reference = null)
    {
        if ($reference){
            $this->reference = $reference;

            $franchisingRepository = new ChargesFranchisingRepository();
            $this->charge = $franchisingRepository->showByReference($this->reference)['data'];
        }
    }

    public function getChargeByFranchising()
    {
        $franchisingRepository = new ChargesFranchisingRepository();
        $franchisingReturnDB = $franchisingRepository->showByReference($this->reference)['data'];

        return $franchisingReturnDB;
    }

    public function getStatusByCharge()
    {
        $chargeStatusRepository = new ChargeStatusRepository();
        $chargeStatusReturnDB = $chargeStatusRepository->getSelectStatusCharge();

        return $chargeStatusReturnDB;
    }

    public function changeStatus($status_id = null)
    {
        $chargeRepository = new ChargesFranchisingRepository();
        $chargeReturnDB = $chargeRepository->changeStatus($this->charge->id, $status_id);

        if($chargeReturnDB['status'] == 'success') {
            $this->notification([
                'title'       => 'Sucesso !',
                'description' => $chargeReturnDB['message'],
                'icon'        => 'success'
            ]);

            $this->emit('refreshCardTop');
            $this->emit('refreshTableChargesReleases');
            $this->emit('refreshTableChargeProposals');
            $this->emit('refreshCardPrecification');
            $this->emit('refreshCardFranchising');

        } else if ($chargeReturnDB['status'] == 'error') {
            $this->dialog([
                'title'       => 'Atenção !',
                'description' => $chargeReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->status = $this->getStatusByCharge();
        $response->charge = $this->getChargeByFranchising();

        return view('livewire.charges.top.card', ['response' => $response]);
    }
}

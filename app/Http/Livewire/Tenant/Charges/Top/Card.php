<?php

namespace App\Http\Livewire\Tenant\Charges\Top;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesFranchisingRepository;
use App\Repositories\ChargeStatusRepository;
use App\Repositories\ConfigurationRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Card extends Component
{
    use Actions, WithModal;

    public $reference;
    public $charge;
    public $configuration;

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
        $franchisingReturnDB = $franchisingRepository->show($this->charge->id)['data'];

        return $franchisingReturnDB;
    }

    public function getStatusChargeByValueAgreement()
    {
        $chargeStatusRepository = new ChargeStatusRepository();
        $chargeStatusReturnDB = $chargeStatusRepository->getSelectStatusChargeByValueAgreement($this->charge->id );

        return $chargeStatusReturnDB;
    }

    public function getLastChargeHistoric()
    {
        if($this->charge){
            $chargeFranchisingRepository = new ChargesFranchisingRepository();
            $chargeFranchisingReturnDB = $chargeFranchisingRepository->getLastChargeHistoric($this->charge['id'])['data'];
            return $chargeFranchisingReturnDB;
        }

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
        $response->status = $this->getStatusChargeByValueAgreement();
        $response->charge = $this->getChargeByFranchising();
        $response->lastHistoric = $this->getLastChargeHistoric();

        return view('livewire.tenant.charges.top.card', ['response' => $response]);
    }
}

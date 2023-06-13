<?php

namespace App\Http\Livewire\Charges\Whatsapp;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesFranchisingRepository;
use App\Repositories\ChargesHistoricsRepository;
use App\Repositories\FranchisingRepository;
use App\Repositories\PartnersRepository;
use App\Services\SendWhatsappService;
use Livewire\Component;
use WireUi\Traits\Actions;

class Form extends Component
{
    use WithModal, Actions;

    public $state = [
        'partner_id' => ''
    ];

    public $franchising;
    public $charge;

    public function mount($id = null)
    {
        if ($id){
            $chargeFranchisingRepository = new ChargesFranchisingRepository();
            $chargeFranchisingReturnDB = $chargeFranchisingRepository->show($id)['data'];
            $this->charge = $chargeFranchisingReturnDB;

            $franchisingRepository = new FranchisingRepository();
            $franchisingReturnDB = $franchisingRepository->view($chargeFranchisingReturnDB['franchising_id'])['data'];

            $this->franchising = $franchisingReturnDB;
        }
    }
    public function getPartnersByFranchising()
    {
        $partnersRepository = new PartnersRepository();
        return $partnersRepository->getSelectPartnersByFranchising($this->franchising['id']);
    }

    public function send()
    {
        $request = $this->state;

        $chargeHistoricRepository = new ChargesHistoricsRepository();
        $chargeHistoricReturnDB = $chargeHistoricRepository->sendWhatsapp($request, $this->charge['id']);

        if($chargeHistoricReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Sucesso !',
                'description' => $chargeHistoricReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableChargeHistoric');

        } else if ($chargeHistoricReturnDB['status'] == 'error') {
            $this->dialog([
                'title'       => 'Atenção !',
                'description' => $chargeHistoricReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->partners = $this->getPartnersByFranchising();

        return view('livewire.charges.whatsapp.form', ['response' => $response]);
    }
}

<?php

namespace App\Http\Livewire\Charges\Historic;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesFranchisingRepository;
use App\Repositories\ChargesHistoricsRepository;
use App\Repositories\ChargeStatusRepository;
use App\Repositories\FranchisingRepository;
use App\Repositories\PartnersRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Form extends Component
{
    use WithModal, Actions;

    public $state = [
        'success' => '',
        'answered' => '',
        'phone' => '',
        'partner_id' => '',
        'type' => 'Unidade',
        'origin' => 'Ativo'
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
            $this->franchising  = $franchisingRepository->view($this->charge['franchising_id'])['data'];

            if($this->state['type'] == 'Unidade') {
                $this->state['phone'] = $this->franchising['phone01'];
            }
        }
    }
    public function updatedStateType()
    {
        if($this->state['type'] == 'Sócio'){
            $this->state['phone'] = '';
        } elseif ($this->state['type'] == 'Unidade'){
            $this->state['phone'] = $this->getFranchising()['phone01'];
        }
    }

    public function updatedStatePartnerId()
    {
        $this->state['phone'] = $this->getPartnerbyID($this->state['partner_id'])['phone'];
    }

    public function updatedStateAnswered()
    {
        if($this->state['answered'] == 'Sim'){
            $this->state['success'] = '';
        } else if($this->state['answered'] == 'Não'){
            $this->state['success'] = 'Não';
        }
    }

    public function getFranchising()
    {
        $franchisingRepository = new FranchisingRepository();
        $franchisingReturnDB = $franchisingRepository->view($this->charge['franchising_id'])['data'];

        return $franchisingReturnDB;
    }
    public function getPartnersByFranchising($franchising_id = null)
    {
        if($this->state['type'] == 'Sócio'){
            $partnersRepository = new PartnersRepository();
            $partnerReturnDB =  $partnersRepository->getSelectPartnersByFranchising($this->franchising['id']);
            return $partnerReturnDB;
        }
    }

    public function getPartnerbyID($id = null)
    {
        $partnersRepository = new PartnersRepository();
        $partnerReturnDB =  $partnersRepository->view($id)['data'];

        return $partnerReturnDB;
    }

    public function save()
    {
        $request = $this->state;

        $chargeHistoricRepository = new ChargesHistoricsRepository();
        $chargeHistoricReturnDB = $chargeHistoricRepository->create($request, $this->charge['id']);

        if($chargeHistoricReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $chargeHistoricReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableChargeHistoric');

        } else if ($chargeHistoricReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
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

        return view('livewire.charges.historic.form', ['response' => $response]);
    }
}

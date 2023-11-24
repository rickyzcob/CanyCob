<?php

namespace App\Http\Livewire\Tenant\Schedule;

use App\Http\Traits\WithModal;
use App\Repositories\ChargeScheduleRepository;
use App\Repositories\ChargesHistoricsRepository;
use App\Repositories\FranchisingRepository;
use App\Repositories\PartnersRepository;
use Carbon\Carbon;
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
        'date_schedule' => '',
        'date_conference' => '',
        'contact' => 'Unidade',
        'origin' => 'Ativo'
    ];

    public $franchising;
    public $event;
    public $charge;
    public $isDisabled = false;

    public function mount($id = null)
    {
        if ($id){
            $chargeScheduleRepository = new ChargeScheduleRepository();
            $chargeScheduleReturnDB = $chargeScheduleRepository->show($id)['data'];

            $this->event = $chargeScheduleReturnDB;
            $this->charge = $chargeScheduleReturnDB['charge'];

            if(!empty($chargeScheduleReturnDB['historic'])) {
                $this->state = $chargeScheduleReturnDB['historic']->toArray();
                $this->state['type'] = $chargeScheduleReturnDB['historic']['type'];
                $this->isDisabled = true;
            }

            $this->franchising  = $chargeScheduleReturnDB['charge']['franchising'];

            if($this->state['contact'] == 'Unidade') {
                $this->state['phone'] = $this->franchising['phone01'];
            }
        }
    }
    public function updatedStateType()
    {
        if($this->state['contact'] == 'Sócio'){
            $this->state['phone'] = '';
        } elseif ($this->state['contact'] == 'Unidade'){
            $this->state['phone'] = $this->getFranchising()['phone01'];
        }
    }

    public function updatedStateSuccess()
    {
        $current = carbon::now();

        if($this->state['success'] == 'Não'){
            $this->state['date_schedule'] = $current->addWeekday(2);
        } else {
            $this->state['date_schedule'] = '';
        }
    }

    public function updatedStatePartnerId()
    {
        $this->state['phone'] = $this->getPartnerbyID($this->state['partner_id'])['phone'];
    }

    public function updatedStateAnswered()
    {
        $current = carbon::now();

        if($this->state['answered'] == 'Sim'){
            $this->state['success'] = '';
        } else if($this->state['answered'] == 'Não'){
            $this->state['success'] = 'Não';
            $this->state['date_schedule'] = $current->addDays(2);
        }
    }

    public function getFranchising()
    {
        $franchisingRepository = new FranchisingRepository();
        $franchisingReturnDB = $franchisingRepository->show($this->charge['franchising_id'])['data'];

        return $franchisingReturnDB;
    }
    public function getPartnersByFranchising($franchising_id = null)
    {
        if($this->state['contact'] == 'Sócio'){
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
        $chargeHistoricReturnDB = $chargeHistoricRepository->create($request, $this->event['id'], $this->event['charge_id']);

        $chargesHistoricRepository = new ChargesHistoricsRepository();
        $chargesHistoricReturnDB = $chargesHistoricRepository->getChargesBySchedule();

        if($chargeHistoricReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $chargeHistoricReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshCardSchedule');
            $this->dispatchBrowserEvent('schedule-updated', ['filter' =>  $chargesHistoricReturnDB]);

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

        return view('livewire.tenant.schedule.form', ['response' => $response]);
    }
}

<?php

namespace App\Http\Livewire\Charges\Simulation;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesFranchisingRepository;
use App\Repositories\ChargesHistoricsRepository;
use App\Repositories\FranchisingRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Form extends Component
{
    use WithModal, Actions;

    public $state = [
        'due_date' => '',
        'value' => '',
        'entry' => '',
    ];

    public $simulate;

    public function mount($id = null)
    {
        if ($id){
            $chargeFranchisingRepository = new ChargesFranchisingRepository();
            $chargeFranchisingReturnDB = $chargeFranchisingRepository->show($id)['data'];

            $this->state['amount'] = $chargeFranchisingReturnDB['total_amount_corrected'];
        }
    }

    public function simulate()
    {
        $request = $this->state;

        $chargeHistoricRepository = new ChargesHistoricsRepository();
        $chargeHistoricReturnDB = $chargeHistoricRepository->simulate($request);

        if($chargeHistoricReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Simulação de Acordo',
                'description' => $chargeHistoricReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->simulate = $chargeHistoricReturnDB['data'];
//            $this->emit('refreshTableChargeHistoric');

        } else if ($chargeHistoricReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao Simular !',
                'description' => $chargeHistoricReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('livewire.charges.simulation.form');
    }
}

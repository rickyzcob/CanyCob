<?php

namespace App\Http\Livewire\Tenant\Charges;

use App\Repositories\ChargesHistoricsRepository;
use Livewire\Component;

class Form extends Component
{
    public function save()
    {
        if($this->chargeStatus){
            return $this->update();
        }

        $request = $this->state;

        $chargeHistoricRepository = new ChargesHistoricsRepository();
        $chargeHistoricRetornDB = $chargeHistoricRepository->create($request);

        if($chargeHistoricRetornDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $chargeHistoricRetornDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableChargeStatus');

        } else if ($chargeHistoricRetornDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $chargeHistoricRetornDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }

    }

    public function render()
    {
        return view('livewire.tenant.charges.form');
    }
}

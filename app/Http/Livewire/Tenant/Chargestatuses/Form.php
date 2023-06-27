<?php

namespace App\Http\Livewire\Tenant\Chargestatuses;

use App\Http\Traits\WithModal;
use App\Repositories\ChargeStatusRepository;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Form extends Component
{
    use Actions, WithModal, WithFileUploads;

    public $state = [
        'color' => '',
        'status' => ''
    ];

    public $chargeStatus;

    public function mount($id = null)
    {
        $chargeStatusRepository = new ChargeStatusRepository();
        $chargeStatusReturnDB = $chargeStatusRepository->view($id)['data'];
        $this->chargeStatus = $chargeStatusReturnDB;

        if($this->chargeStatus){
            $this->state = $this->chargeStatus->toArray();
        }
    }

    public function save()
    {
        if($this->chargeStatus){
            return $this->update();
        }

        $request = $this->state;

        $chargeStatusRepository = new ChargeStatusRepository();
        $chargeStatusReturnDB = $chargeStatusRepository->create($request);

        if($chargeStatusReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $chargeStatusReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableChargeStatus');

        } else if ($chargeStatusReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $chargeStatusReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function update()
    {
        $request = $this->state;
        $chargeStatusRepository = new ChargeStatusRepository();

        $chargeStatusReturnDB = $chargeStatusRepository->update($this->chargeStatus->id, $request);

        if($chargeStatusReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Atualizado com Sucesso !',
                'description' => $chargeStatusReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableChargeStatus');
        } else if ($chargeStatusReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $chargeStatusReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('livewire.tenant.chargestatuses.form');
    }
}

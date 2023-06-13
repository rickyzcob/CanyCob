<?php

namespace App\Http\Livewire\Fees;

use App\Http\Traits\WithModal;
use App\Repositories\FeesRepository;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Form extends Component
{
    use Actions, WithModal, WithFileUploads;

    public $state = [
        'automatic' => '',
        'status' => '',
        'value' => '',
        'type' => ''
    ];

    public $fees;

    public function mount($id = null)
    {
        $feesRepository = new FeesRepository();
        $feesReturnDB = $feesRepository->show($id)['data'];
        $this->fees = $feesReturnDB;

        if($this->fees){
            $this->state = $this->fees->toArray();
        }
    }

    public function save()
    {
        if($this->fees){
            return $this->update();
        }

        $request = $this->state;

        $feesRepository = new FeesRepository();
        $feesReturnDB = $feesRepository->create($request);

        if($feesReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $feesReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableFees');

        } else if ($feesReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $feesReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }

    }

    public function update()
    {
        $request = $this->state;
        $feesRepository = new FeesRepository();

        $feesReturnDB = $feesRepository->update($this->fees->id, $request);

        if($feesReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Atualizado com Sucesso !',
                'description' => $feesReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableFees');
        } else if ($feesReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $feesReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('livewire.fees.form');
    }
}

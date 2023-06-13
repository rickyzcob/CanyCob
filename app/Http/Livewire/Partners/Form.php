<?php

namespace App\Http\Livewire\Partners;

use App\Http\Traits\WithModal;
use App\Repositories\PartnersRepository;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Form extends Component
{
    use Actions, WithModal, WithFileUploads;

    public $state = [
        'status' => '',
        'phone' => '',
        'cpf' => ''
    ];

    public $partner;

    public function mount($id = null)
    {
        $partnersRepository = new PartnersRepository();
        $partnersReturnDB = $partnersRepository->view($id)['data'];
        $this->partner = $partnersReturnDB;

        if($this->partner){
            $this->state = $this->partner->toArray();
        }
    }

    public function save()
    {
        if($this->partner){
            return $this->update();
        }

        $request = $this->state;

        $partnersRepository = new PartnersRepository();
        $partnersReturnDB = $partnersRepository->create($request);

        if($partnersReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $partnersReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTablePartners');

        } else if ($partnersReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $partnersReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }

    }

    public function update()
    {
        $request = $this->state;
        $partnersRepository = new PartnersRepository();

        $partnersReturnDB = $partnersRepository->update($this->partner->id, $request);

        if($partnersReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Aturalizado com Sucesso !',
                'description' => $partnersReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTablePartners');
        } else if ($partnersReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $partnersReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('livewire.partners.form');
    }
}

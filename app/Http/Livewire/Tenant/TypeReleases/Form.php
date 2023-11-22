<?php

namespace App\Http\Livewire\Tenant\TypeReleases;

use App\Http\Traits\WithModal;
use App\Repositories\ChargeStatusRepository;
use App\Repositories\TypeReleasesRepository;
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

    public $typeReleases;

    public function mount($id = null)
    {
        $typeReleasesRepository = new TypeReleasesRepository();
        $typeReleasesReturnDB = $typeReleasesRepository->show($id)['data'];
        $this->typeReleases = $typeReleasesReturnDB;

        if($this->typeReleases){
            $this->state = $this->typeReleases->toArray();
        }
    }

    public function save()
    {
        if($this->typeReleases){
            return $this->update();
        }

        $request = $this->state;

        $typeReleasesRepository = new TypeReleasesRepository();
        $typeReleasesReturnDB = $typeReleasesRepository->create($request);

        if($typeReleasesReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $typeReleasesReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableTypeReleases');

        } else if ($typeReleasesReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $typeReleasesReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function update()
    {
        $request = $this->state;
        $typeReleasesRepository = new TypeReleasesRepository();

        $typeReleasesReturnDB = $typeReleasesRepository->update($this->typeReleases->id, $request);

        if($typeReleasesReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Atualizado com Sucesso !',
                'description' => $typeReleasesReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableTypeReleases');
        } else if ($typeReleasesReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $typeReleasesReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }
    public function render()
    {
        return view('livewire.tenant.type-releases.form');
    }
}

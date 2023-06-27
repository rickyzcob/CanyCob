<?php

namespace App\Http\Livewire\Admin\Clients;

use App\Http\Traits\WithModal;
use App\Repositories\Admin\ClientsRepository;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Form extends Component
{
    use Actions, WithModal, WithFileUploads;

    public $state = [
        'status' => '',
        'user' => [
            'phone' => '',
            'document' => '',
            'status' => '',
        ]
    ];
    public $client;

    public function mount($id = null)
    {
        $clientRepository = new ClientsRepository();
        $clientReturnDB = $clientRepository->show($id)['data'];
        $this->client = $clientReturnDB;

        if($this->client){
            $this->state = $this->client->toArray();
        }
    }

    public function save()
    {
        if($this->client){
            return $this->update();
        }

        $request = $this->state;

        $clientRepository = new ClientsRepository();
        $clientReturnDB = $clientRepository->create($request);

        if($clientReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $clientReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableClients');


        } else if ($clientReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $clientReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }

    }

    public function update()
    {
        $request = $this->state;
        $clientRepository = new ClientsRepository();

        $clientReturnDB = $clientRepository->update($request, $this->client->id);

        if($clientReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $clientReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableClients');
        } else if ($clientReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $clientReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }



    public function render()
    {
        return view('livewire.admin.clients.form');
    }
}

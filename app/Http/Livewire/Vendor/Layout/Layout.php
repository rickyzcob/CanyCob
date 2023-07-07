<?php

namespace App\Http\Livewire\Vendor\Layout;

use App\Http\Traits\WithModal;
use App\Repositories\ConfigurationRepository;
use App\Services\ChangeColorsService;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Layout extends Component
{
    use Actions, WithModal, WithFileUploads;

    public $state = [];
    public $color;

    public $configuration;

    public function mount($id = null)
    {
        $configurationRepository = new ConfigurationRepository();
        $configurationReturnDB = $configurationRepository->getConfiguration();
        $this->configuration = $configurationReturnDB;

        $changeColorsService = new ChangeColorsService();
        $toHEX= $changeColorsService->convertHSLtoRGBorHEX($this->configuration->toArray()['color'], true);

        if($this->configuration){
            $this->color = $toHEX;
        }
    }

    public function update()
    {
        $validatedData = $this->validate([
            'color' => 'required',
        ]);

        $configurationRepository = new ConfigurationRepository();
        $clientReturnDB = $configurationRepository->changeColor($validatedData['color']);

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
        return view('livewire.vendor.layout.layout');
    }
}

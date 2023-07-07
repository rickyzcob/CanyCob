<?php

namespace App\Http\Livewire\Vendor\Configuration;

use App\Repositories\ConfigurationRepository;
use App\Services\AddressService;
use Livewire\Component;
use WireUi\Traits\Actions;

class Data extends Component
{
    use Actions;

    public $state = [
        'entities_number' => '',
        'zip_code' => ''
    ];

    public $configuration;

    public function mount($id = null)
    {
        $configurationRepository = new ConfigurationRepository();
        $configurationReturnDB = $configurationRepository->getConfiguration();
        $this->configuration = $configurationReturnDB;

        if($this->configuration){
            $this->state = $this->configuration->toArray();
        }

        $this->state['goals_coins'] = formatCoin($this->state['goals_coins']);
    }

    public function updatedStateZipcode()
    {
        if($this->state['zip_code']){
            $addressService  = new AddressService();
            $addressServiceReturn = $addressService->consultCEP($this->state['zip_code']);

            $this->state['address'] = $addressServiceReturn->logradouro;
            $this->state['neighborhood'] = $addressServiceReturn->bairro;
            $this->state['city'] = $addressServiceReturn->localidade;
            $this->state['uf'] = $addressServiceReturn->uf;
        }
    }
    public function update()
    {
        $request = $this->state;
        $configurationRepository = new ConfigurationRepository();

        $configurationReturnDB = $configurationRepository->updateConfigurationData($request);

        if($configurationReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Atualizado com Sucesso !',
                'description' => $configurationReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableFees');
        } else if ($configurationReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $configurationReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('livewire.vendor.configuration.data');
    }
}

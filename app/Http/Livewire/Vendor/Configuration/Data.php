<?php

namespace App\Http\Livewire\Vendor\Configuration;

use App\Repositories\ConfigurationRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Data extends Component
{
    use Actions;

    public $state = [];

    public $configuration;

    public function mount($id = null)
    {
        $configurationRepository = new ConfigurationRepository();
        $configurationReturnDB = $configurationRepository->getConfiguration();
        $this->configuration = $configurationReturnDB;

        if($this->configuration){
            $this->state = $this->configuration->toArray();
        }

        $this->state['value_agreement'] = formatMoney($this->state['value_agreement']);
        $this->state['goals_coins'] = formatCoin($this->state['goals_coins']);
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

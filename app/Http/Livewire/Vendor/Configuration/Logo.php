<?php

namespace App\Http\Livewire\Vendor\Configuration;

use App\Repositories\ConfigurationRepository;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Logo extends Component
{
    use Actions, WithFileUploads;

    public $logo;

    public function mount()
    {
        $configurationRepository = new ConfigurationRepository();
        $configurationReturnDB = $configurationRepository->getConfiguration();
        $this->logo = $configurationReturnDB['logo'];
    }

    public function updatedLogo()
    {
        $this->validate([
            'logo' => 'image|max:1024',
        ]);
    }

    public function update()
    {

        $configurationRepository = new ConfigurationRepository();

        $configurationReturnDB = $configurationRepository->uploadLogo($this->logo);

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
        return view('livewire.vendor.configuration.logo');
    }
}

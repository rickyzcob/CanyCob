<?php

namespace App\Http\Livewire\Vendor\Configuration;

use App\Repositories\ClickSignRepository;
use App\Repositories\ConfigurationRepository;
use App\Repositories\UserRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class ClickSign extends Component
{
    use Actions;

    public $state = [];

    public $clicksign;

    public function mount($id = null)
    {
        $clickSingRepository = new ClickSignRepository();
        $clickSignReturnDB = $clickSingRepository->getClickSing();

        $this->clicksign = $clickSignReturnDB;

        if($this->clicksign){
            $this->state = $this->clicksign->toArray();
        }
    }

    public function update()
    {
        $request = $this->state;
        $clickSingRepository = new ClickSignRepository();

        $clickSignReturnDB = $clickSingRepository->update($request, $this->clicksign->id);

        if($clickSignReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Atualizado com Sucesso !',
                'description' => $clickSignReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableFees');
        } else if ($clickSignReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $clickSignReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function save()
    {
        if($this->clicksign){
            return $this->update();
        }

        $request = $this->state;

        $clickSingRepository = new ClickSignRepository();
        $clickSignReturnDB = $clickSingRepository->create($request);

        if($clickSignReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $clickSignReturnDB['message'],
                'icon'        => 'success'
            ]);

        } else if ($clickSignReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $clickSignReturnDB['message'],
                'icon'        => 'error'
            ]);

        }

    }


    public function render()
    {
        return view('livewire.vendor.configuration.click-sign');
    }
}

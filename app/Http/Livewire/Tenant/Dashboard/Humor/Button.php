<?php

namespace App\Http\Livewire\Tenant\Dashboard\Humor;

use App\Repositories\CoinsRepository;
use Livewire\Component;

class Button extends Component
{
    protected $listeners = ['showHumorModal', 'closeHumorModal'];

    public $showHumorModal = false;

    public function showHumorModal($compomemt = null, $params = null)
    {
        $this->showHumorModal = true;
    }

    public function closeHumorModal()
    {
        $this->showHumorModal = false;
    }

    public function getHumorDaily()
    {
        sleep(5);
        $coinsRepository = new CoinsRepository();
        return $coinsRepository->getLastCoinByHumor();
    }


    public function render()
    {
        $return =  $this->getHumorDaily();
        return view('livewire.tenant.dashboard.humor.button', compact('return'));
    }
}

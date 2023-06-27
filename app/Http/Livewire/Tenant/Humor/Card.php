<?php

namespace App\Http\Livewire\Tenant\Humor;

use App\Http\Traits\WithModal;
use App\Repositories\CoinsRepository;
use Livewire\Component;
class Card extends Component
{
    use WithModal;
    public function getHumorByDay()
    {
        $coinsRepository = new CoinsRepository();
        $coinsReturnDB = $coinsRepository->getHumorByUserDaily()['data'];
        return $coinsReturnDB;
    }

    public function render()
    {
        $response = new \stdClass();
        $response->humor = $this->getHumorByDay();

        return view('livewire.tenant.humor.card', ['response' => $response]);
    }
}

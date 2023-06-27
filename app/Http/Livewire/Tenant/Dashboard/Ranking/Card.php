<?php

namespace App\Http\Livewire\Tenant\Dashboard\Ranking;

use App\Repositories\CoinsRepository;
use App\Repositories\ConfigurationRepository;
use Livewire\Component;

class Card extends Component
{

    protected $listeners = ['refreshCardRanking' => '$refresh'];

    public $coins;

    public function mount()
    {
        $configurationRepository = new ConfigurationRepository();
        $configurationReturnDB = $configurationRepository->getConfiguration();
        $this->coins = $configurationReturnDB['goals_coins'];

    }
    public function getUserbyCoin()
    {
        $coinsRepository = new CoinsRepository();
        return $coinsRepository->getUsersByCoin()['data'];
    }

    public function render()
    {
        $response = new \stdClass();
        $response->users = $this->getUserbyCoin();

        return view('livewire.tenant.dashboard.ranking.card', ['response' => $response]);
    }
}

<?php

namespace App\Http\Livewire\Dashboard\Ranking;

use App\Models\Coins;
use App\Repositories\CoinsRepository;
use Livewire\Component;

class Card extends Component
{
    protected $listeners = ['refreshCardRanking' => '$refresh'];
    public function getUserbyCoin()
    {
        $coinsRepository = new CoinsRepository();
        return $coinsRepository->getUsersByCoin()['data'];
    }

    public function render()
    {
        $response = new \stdClass();
        $response->users = $this->getUserbyCoin();

        return view('livewire.dashboard.ranking.card', ['response' => $response]);
    }
}

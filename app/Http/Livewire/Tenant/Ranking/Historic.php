<?php

namespace App\Http\Livewire\Tenant\Ranking;

use App\Repositories\CoinsRepository;
use Livewire\Component;

class Historic extends Component
{
    public $user_id;
    public $pageSize = null;


    public function mount($id = null)
    {
        if($id){
            $this->user_id = $id;
        }
    }

    public function getCoinsByUser()
    {
        $coinsRepository = new CoinsRepository();
        $coinsReturnDB = $coinsRepository->getHistoricMonthlyCoinsByUser($this->user_id, $this->pageSize)['data'];
        return $coinsReturnDB;

    }

    public function render()
    {
        $response = new \stdClass();
        $response->coins = $this->getCoinsByUser();

        return view('livewire.tenant.ranking.historic', ['response' => $response]);
    }
}

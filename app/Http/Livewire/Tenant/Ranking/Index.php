<?php

namespace App\Http\Livewire\Tenant\Ranking;

use App\Repositories\CoinsRepository;
use App\Repositories\FeesRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;

    public function resetCoinsByMonth()
    {
        $feesRepository = new CoinsRepository();
        $feesReturnDB = $feesRepository->reseMonthCoins();

        if($feesReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $feesReturnDB['message'],
                'icon'        => 'success'
            ]);
//            $this->emit('closeModal');
            $this->emit('refreshTableRanking');

        } else if ($feesReturnDB['status'] == 'error') {
            $this->dialog([
                'title'       => 'Atençao !',
                'description' => $feesReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('livewire.tenant.ranking.index');
    }
}

<?php

namespace App\Http\Livewire\Tenant\Dashboard\Humor;

use App\Http\Traits\WithModal;
use App\Repositories\CoinsRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Card extends Component
{
    use WithPagination, WithModal, Actions;

    public $state = [];

    protected $listeners = ['addHumor' => 'submit'];

    public function submit()
    {
        $validatedData = $this->validate([
            'state.humor' => 'required',
            'state.description' => 'sometimes|nullable|min:10'
        ]);

        $coinsRepository = new CoinsRepository();
        $coinsReturnDB = $coinsRepository->create($validatedData['state'], 'Humor', Auth::user()->id);

        if($coinsReturnDB['status'] == 'success') {
            $this->emit('refreshCardRanking');
            $this->emit('closeHumorModal');
            $this->notification([
                'title'       => 'Obrigado !',
                'description' => $coinsReturnDB['message'],
                'icon'        => 'success'
            ]);
        } else if ($coinsReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Atenção !',
                'description' => $coinsReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeCentralModal');
        }

    }

    public function render()
    {
        return view('livewire.tenant.dashboard.humor.card');
    }
}

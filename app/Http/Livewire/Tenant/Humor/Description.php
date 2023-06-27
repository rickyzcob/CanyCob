<?php

namespace App\Http\Livewire\Tenant\Humor;

use App\Repositories\CoinsRepository;
use Livewire\Component;

class Description extends Component
{
    public $humor;

    public function mount($id = null)
    {
        if($id){
            $coinsRepository = new CoinsRepository();
            $coinsReturnDB = $coinsRepository->show($id)['data'];
            $this->humor = $coinsReturnDB;
        }
    }

    public function render()
    {
        return view('livewire.tenant.humor.description');
    }
}

<?php

namespace App\Http\Livewire\Profile;

use App\Repositories\FeesRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class Form extends Component
{
    use Actions;

    public $state = [
    ];

    public $fees;

    public function mount($id = null)
    {
        $feesRepository = new UserRepository();
        $feesReturnDB = $feesRepository->show(Auth::user()->id)['data'];
        $this->fees = $feesReturnDB;

        if($this->fees){
            $this->state = $this->fees->toArray();
        }
    }

    public function update()
    {
        $request = $this->state;
        $feesRepository = new UserRepository();

        $feesReturnDB = $feesRepository->updateProfile(Auth::user()->id, $request);

        if($feesReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Atualizado com Sucesso !',
                'description' => $feesReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableFees');
        } else if ($feesReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $feesReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('livewire.profile.form');
    }
}

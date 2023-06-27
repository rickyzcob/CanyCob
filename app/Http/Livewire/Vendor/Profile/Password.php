<?php

namespace App\Http\Livewire\Vendor\Profile;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class Password extends Component
{
    use Actions;

    public $state = [];

    public function update()
    {
        $request = $this->state;
        $feesRepository = new UserRepository();

        $feesReturnDB = $feesRepository->updatePassword(Auth::user()->id, $request);

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
        return view('livewire.vendor.profile.password');
    }
}

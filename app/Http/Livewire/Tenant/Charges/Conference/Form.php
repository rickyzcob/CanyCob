<?php

namespace App\Http\Livewire\Tenant\Charges\Conference;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesFranchisingRepository;
use App\Repositories\FranchisingRepository;
use App\Repositories\ReleasesRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Form extends Component
{
    use WithModal, Actions;

    public $state = [];
    public $charge_id;

    public function mount($id = null)
    {

        if ($id){
            $this->charge_id = $id;
        }
    }

    public function save()
    {
        $request = $this->state;

        $releasesRepository = new ChargesFranchisingRepository();
        $releasesReturnDB = $releasesRepository->addPaymentCode($request, $this->charge_id);

        if($releasesReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Reprecificação !',
                'description' => $releasesReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');

            $this->emit('refreshCardTop');
            $this->emit('refreshCardPrecification');
            $this->emit('refreshTableChargesReleases');

        } else if ($releasesReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $releasesReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }


    }

    public function render()
    {
        return view('livewire.tenant.charges.conference.form');
    }
}

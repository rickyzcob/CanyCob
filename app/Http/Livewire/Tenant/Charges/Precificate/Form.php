<?php

namespace App\Http\Livewire\Tenant\Charges\Precificate;

use App\Http\Traits\WithModal;
use App\Repositories\FeesRepository;
use App\Repositories\ReleasesRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Form extends Component
{
    use WithModal, Actions;

    public $state = [
        'fees_month' => '',
        'fees_year' =>   ''
    ];

    public $charge_id;

    public function mount($charge_id = null)
    {
        if($charge_id){
            $this->charge_id = $charge_id;
        }

    }

    public function getSelectAnualFees()
    {
        $feesRepository = new FeesRepository();
        return $feesRepository->getAnualFeesSelect();
    }

    public function getSelectMonthFees()
    {
        $feesRepository = new FeesRepository();
        return $feesRepository->getMonthFeesSelect();
    }

    public function save()
    {
        $request = $this->state;

        $releasesRepository = new ReleasesRepository();
        $releasesReturnDB = $releasesRepository->reprecificateReleases($request, $this->charge_id);

        if($releasesReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Reprecificação !',
                'description' => $releasesReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');

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
        $response = new \stdClass();
        $response->anualfees = $this->getSelectAnualFees();
        $response->monthfees = $this->getSelectMonthFees();

        return view('livewire.tenant.charges.precificate.form', ['response' => $response]);
    }
}

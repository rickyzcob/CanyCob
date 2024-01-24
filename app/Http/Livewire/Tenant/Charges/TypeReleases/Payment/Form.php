<?php

namespace App\Http\Livewire\Tenant\Charges\TypeReleases\Payment;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesTypeReleasesRepository;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\ReleasesRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Form extends Component
{
    use Actions, WithModal;
    public $state = [
        'type' => '',
        'due_date' => ''
    ];

    public $typeRelease;

    public function mount($id = null)
    {
        if($id) {
            $chargeTypeReleasesRepository = new ChargesTypeReleasesRepository();
            $chargeFranchisingReturnDB = $chargeTypeReleasesRepository->show($id)['data'];
            $this->typeRelease = $chargeFranchisingReturnDB;
        }
    }
    public function getSelectPaymentMethods()
    {
        $paymentMethodRepository = new PaymentMethodRepository();
        return $paymentMethodRepository->getSelectPaymentByActive($this->typeRelease->type_release_id)['data'];
    }

    public function save()
    {
        $request = $this->state;

        $releasesRepository = new ReleasesRepository();
        $releasesReturnDB = $releasesRepository->create($request, $this->typeRelease->id);

        if($releasesReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $releasesReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal2');
            $this->emit('refreshCardPayments');

        } else if ($releasesReturnDB['status'] == 'error') {
            $this->emit('closeModal2');
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $releasesReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal2');
        }

    }

    public function render()
    {
        $response = new \stdClass();
        $response->paymentMethod = $this->getSelectPaymentMethods();

        return view('livewire.tenant.charges.type-releases.payment.form', ['response' => $response]);
    }
}

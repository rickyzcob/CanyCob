<?php

namespace App\Http\Livewire\Tenant\TypeReleases\PaymentMethod;

use App\Http\Traits\WithModal;
use App\Repositories\BankRepository;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\TypeReleasesRepository;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Form extends Component
{
    use Actions, WithModal, WithFileUploads;

    public $state = [
        'type' => '',
        'status' => ''
    ];

    public $paymentMethod;
    public $type_release_id;

    public function mount($id = null, $type_release_id = null)
    {
        $paymentMethodRepository = new PaymentMethodRepository();
        $paymentMethodReturnDB = $paymentMethodRepository->show($id)['data'];
        $this->paymentMethod = $paymentMethodReturnDB;
        $this->type_release_id = $type_release_id;

        if($this->paymentMethod){
            $this->state = $this->paymentMethod->toArray();
        }
    }

    public function getBankbyCode()
    {
        $bankRepository = new BankRepository();
        if(isset($this->state['code'])){
            $bankReturnDB = $bankRepository->getBankByCode($this->state['code'])['data'];
            if($bankReturnDB != null){
                $this->state['bank'] = $bankReturnDB['name'];
                $this->notification([
                    'title'       => 'Sucesso !',
                    'description' => $bankReturnDB['message'],
                    'icon'        => 'success'
                ]);
            } else {
                $this->notification([
                    'title'       => 'Inexistente  !',
                    'description' => 'Banco não encontrado .',
                    'icon'        => 'error'
                ]);
            }
        }
    }

    public function save()
    {
        if($this->paymentMethod){
            return $this->update();
        }

        $request = $this->state;

        $paymentMethodRepository = new PaymentMethodRepository();
        $paymentMethodReturnDB = $paymentMethodRepository->create($request, $this->type_release_id);

        if($paymentMethodReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $paymentMethodReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal2');
            $this->emit('refreshTablePaymentMethod');

        } else if ($paymentMethodReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $paymentMethodReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function update()
    {
        $request = $this->state;
        $paymentMethodRepository = new PaymentMethodRepository();

        $paymentMethodReturnDB = $paymentMethodRepository->update($this->paymentMethod->id, $request);

        if($paymentMethodReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Atualizado com Sucesso !',
                'description' => $paymentMethodReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal2');
            $this->emit('refreshTablePaymentMethod');
        } else if ($paymentMethodReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $paymentMethodReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }
    public function render()
    {
        return view('livewire.tenant.type-releases.payment-method.form');
    }
}

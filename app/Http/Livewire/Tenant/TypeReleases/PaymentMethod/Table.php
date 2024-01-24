<?php

namespace App\Http\Livewire\Tenant\TypeReleases\PaymentMethod;

use App\Http\Traits\WithModal;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\TypeReleasesRepository;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Table extends Component
{
    use Actions, WithModal, WithPagination;

    public $typeRelease;

    public $filters;

    public $pageSize = 10;

    public $order = [
        'column' => 'type',
        'order' => 'ASC'
    ];

    protected $listeners = [
        'refreshTablePaymentMethod' => '$refresh',
        'confirmDeletePaymentMethod' => 'delete',
        'filterTablePaymentMethod'
    ];

    public function mount($id = null)
    {
        if($id) {
            $typeReleaseRepository = new TypeReleasesRepository();
            $typeReleaseReturnDB = $typeReleaseRepository->show($id)['data'];

            $this->typeRelease = $typeReleaseReturnDB;
        }
    }

    public function getPaymentMethodByTypeRelease()
    {
        $paymentMethodRepository = new PaymentMethodRepository();
        $paymentMehodReturnDB = $paymentMethodRepository->index($this->filters, $this->pageSize, $this->order, $this->typeRelease->id)['data'];

        return $paymentMehodReturnDB;
    }

    public function delete($id = null)
    {
        $paymentMethodRepository = new PaymentMethodRepository();
        $paymentMehodReturnDB = $paymentMethodRepository->delete($id);

        if($paymentMehodReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Deletar !',
                'description' => $paymentMehodReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeConfirmModal');
            $this->emit('refreshTableTypeReleases');
        } else if ($paymentMehodReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Deletar',
                'description' => $paymentMehodReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeConfirmModal');
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->paymentMethod = $this->getPaymentMethodByTypeRelease();

        return view('livewire.tenant.type-releases.payment-method.table', ['response' => $response]);
    }
}

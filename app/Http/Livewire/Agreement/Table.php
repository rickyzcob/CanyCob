<?php

namespace App\Http\Livewire\Agreement;

use App\Http\Traits\WithModal;
use App\Repositories\AgreementRepository;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Table extends Component
{
    use Actions;

    use Actions, WithModal, WithPagination;

    private $franchising;
    public $filters;

    public $pageSize = 10;

    public $order = [
        'column' => 'name',
        'order' => 'ASC'
    ];

    protected $listeners = [
        'refreshTableAgreements' => '$refresh',
        'confirmDelete' => 'delete',
        'filterTableAgreements'
    ];

    public function filterTableAgreements($filterData = null)
    {
        $this->filters = $filterData;
    }
    public function getAgreements()
    {
        $agreementsRepository = new AgreementRepository();
        $agreementReturnDB = $agreementsRepository->index($this->filters, $this->pageSize, $this->order)['data'];

        return $agreementReturnDB;
    }

    public function generateDocument($id = null)
    {
        $agreementsRepository = new AgreementRepository();
        $agreementReturnDB = $agreementsRepository->generateDocument($id);

        if($agreementReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Sucesso !',
                'description' => $agreementReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshCardTop');
            $this->emit('refreshTableAgreement');

        } else if ($agreementReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro !',
                'description' => $agreementReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function sendEmail($id = null)
    {
        $agreementsRepository = new AgreementRepository();
        $agreementReturnDB = $agreementsRepository->sendEmail($id);

        if($agreementReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Sucesso !',
                'description' => $agreementReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('refreshCardTop');
            $this->emit('refreshTableAgreement');

        } else if ($agreementReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro !',
                'description' => $agreementReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->agreements = $this->getAgreements();

        return view('livewire.agreement.table', ['response' => $response]);
    }
}

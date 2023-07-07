<?php

namespace App\Http\Livewire\Tenant\Agreement;

use App\Http\Traits\WithModal;
use App\Repositories\AgreementRepository;
use Illuminate\Support\Facades\Auth;
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

        if(Auth::user()->tenant->type_agreement == 'Normal') {
            $agreementReturnDB = $agreementsRepository->genererateWord($id);
        } elseif (Auth::user()->tenant->type_agreement == 'ClickSign') {
            $agreementReturnDB = $agreementsRepository->generateDocument($id);
        }


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
            $this->dialog([
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

    public function changeStatus($id = null, $status_id = null)
    {
        $agreementsRepository = new AgreementRepository();
        $agreementReturnDB = $agreementsRepository->changeStatus($id, $status_id);

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

    public function downloadDocument($id = null)
    {
        $agreementsRepository = new AgreementRepository();
        $agreementReturnDB = $agreementsRepository->downloadDocument($id);

        if($agreementReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Sucesso !',
                'description' => $agreementReturnDB['message'],
                'icon'        => 'success'
            ]);

            return response()->download(storage_path($agreementReturnDB['data']['file']));

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

        return view('livewire.tenant.agreement.table', ['response' => $response]);
    }
}

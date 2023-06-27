<?php

namespace App\Http\Livewire\Tenant\Charges\Agreement;

use App\Http\Traits\WithModal;
use App\Repositories\AgreementRepository;
use App\Repositories\ChargesFranchisingRepository;
use App\Repositories\PartnersRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Form extends Component
{
    use Actions, WithModal;

    public $state = [
        'due_date' => '',
        'amount_corrected' => '',
        'amount_balance' => '',
        'balance_value' => '',
        'inflow' => '',
        'installment_value' => '',
    ];

    public $charge;
    public $proposal;

    public function mount($id = null)
    {
        if ($id){
            $this->charge_id = $id;
            $chargeFranchisingRepository = new ChargesFranchisingRepository();
            $chargeFranchisingReturnDB = $chargeFranchisingRepository->show($id)['data'];

            $this->charge = $chargeFranchisingReturnDB;
        }
    }

    public function save()
    {
        $request = $this->state;

        $feesRepository = new AgreementRepository();
        $feesReturnDB = $feesRepository->create($request, $this->charge['id']);

        if($feesReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $feesReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshCardProposalComercial');
            $this->emit('refreshCardTop');
            $this->emit('refreshTableAgreement');

        } else if ($feesReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $feesReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function getDataProposal()
    {
        $chargeFranchisingRepository = new ChargesFranchisingRepository();
        $chargeFranchisingReturnDB = $chargeFranchisingRepository->show($this->charge_id)['data'];

        $this->state['partner_id'] = $chargeFranchisingReturnDB['proposalAccept']['partner_id'];
        $this->state['amount_corrected'] = $chargeFranchisingReturnDB['total_amount_corrected'];
        $this->state['inflow'] = formatMoneyInput($chargeFranchisingReturnDB['proposalAccept']['inflow']);
        $this->state['installments'] = $chargeFranchisingReturnDB['proposalAccept']['installments'];
        $this->state['amount_balance'] = $chargeFranchisingReturnDB['proposalAccept']['amount_balance'];
        $this->state['installment_value'] = formatMoneyInput($chargeFranchisingReturnDB['proposalAccept']['installment_value']);
    }
    public function getSelectPartnersByFranchising()
    {
        $partnersRepository = new PartnersRepository();
        return $partnersRepository->getPartnersFranchisings($this->charge['franchising_id']);
    }

    public function render()
    {
        $response = new \stdClass();
        $response->partners = $this->getSelectPartnersByFranchising();

        return view('livewire.tenant.charges.agreement.form', ['response' => $response]);
    }
}

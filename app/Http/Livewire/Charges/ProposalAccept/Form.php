<?php

namespace App\Http\Livewire\Charges\ProposalAccept;

use App\Http\Traits\WithModal;
use App\Repositories\ChargesFranchisingRepository;
use App\Repositories\PartnersRepository;
use App\Repositories\ProposalAcceptRepository;
use App\Repositories\ProposalRepository;
use App\Repositories\TemplateProposalRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Form extends Component
{
    use Actions, WithModal;

    public $state = [
        'template_proposal_id' => '',
        'partner_id' => '',
        'installments' => '',
        'inflow' => '',
        'days' => ''
    ];

    public $charge;

    public function mount($id = null)
    {
        if ($id){
            $chargeFranchisingRepository = new ChargesFranchisingRepository();
            $chargeFranchisingReturnDB = $chargeFranchisingRepository->show($id)['data'];
            $this->charge = $chargeFranchisingReturnDB;

            $this->state['amount_corrected'] = $this->charge['total_amount_corrected'];

//            $franchisingRepository = new FranchisingRepository();
//            $franchisingReturnDB = $franchisingRepository->view($chargeFranchisingReturnDB->franchising_id)['data'];
//
//            $this->franchising = $franchisingReturnDB;
        }
    }

    public function getSelectTemplatesProposals()
    {
        $templateProposalRepository = new TemplateProposalRepository();
        return $templateProposalRepository->getSelectTemplateProposal('Formal')['data'];
    }

    public function getSelectPartnersByFranchising()
    {
        $partnersRepository = new PartnersRepository();
        return $partnersRepository->getPartnersFranchisings($this->charge['franchising_id']);
    }

    public function save()
    {
        $request = $this->state;

        $feesRepository = new ProposalAcceptRepository();
        $feesReturnDB = $feesRepository->create($request, $this->charge['id']);

        if($feesReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $feesReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshCardProposalComercial');

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
        $response = new \stdClass();
        $response->templatePrososals = $this->getSelectTemplatesProposals();
        $response->partners = $this->getSelectPartnersByFranchising();

        return view('livewire.charges.proposal-accept.form', ['response' => $response]);
    }
}

<?php

namespace App\Http\Livewire\Tenant\Franchising\Partners;

use App\Http\Repository\Time\UserRepository;
use App\Http\Traits\WithModal;
use App\Repositories\PartnersRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Form extends Component
{
    use Actions, WithModal;

    public $state = [
        'partner_id' => ''
    ];

    public $franchising_id;

    public function mount($id = null)
    {
        if($id) {
            $this->franchising_id = $id;
        }
    }

    public function getPartners()
    {
        $partnersRepository = new PartnersRepository();
        return $partnersRepository->getSelectPartner()['data'];

    }

    public function save()
    {
        $request = $this->state;

        $partnersRepository = new PartnersRepository();
        $partnersReturnDB = $partnersRepository->addPartnerFranchising($request, $this->franchising_id);

        if($partnersReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Adicionado com Sucesso !',
                'description' => $partnersReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal2');

            $this->emit('refreshTableFranchisingContacts');


        } else if ($partnersReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $partnersReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal2');
        }

    }

    public function render()
    {
        $response = new \stdClass();
        $response->partners = $this->getPartners();

        return view('livewire.tenant.franchising.partners.form', ['response' => $response]);
    }
}

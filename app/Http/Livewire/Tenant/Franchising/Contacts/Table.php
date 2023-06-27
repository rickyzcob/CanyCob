<?php

namespace App\Http\Livewire\Tenant\Franchising\Contacts;

use App\Http\Repository\Time\BrandRepository;
use App\Http\Traits\WithModal;
use App\Repositories\ContactsFranchinsingRepository;
use App\Repositories\FranchisingRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Table extends Component
{
    use WithModal, Actions;

    public $franchising;

    protected $listeners = [
        'refreshTableFranchisingContacts' => '$refresh',
        'confirmDeleteContact' => 'delete',
    ];

    public function mount($id = null)
    {
        if($id){
            $this->franchising_id = $id;
            $franchisingRepository = new FranchisingRepository();
            $franchisingReturnDB = $franchisingRepository->show($id)['data']->toArray();

            $this->franchising = $franchisingReturnDB;
        }
    }

    public function getContactFranchising()
    {
        $contactFranchisingRepository = new ContactsFranchinsingRepository();
        $contactReturnDB = $contactFranchisingRepository->getContactsFranchisings($this->franchising_id);

        return $contactReturnDB;
    }

    public function delete($id = null)
    {
        $contactFranchisingRepository = new ContactsFranchinsingRepository();
        $contactReturnDB = $contactFranchisingRepository->delete($id);

        if($contactReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Deletar !',
                'description' => $contactReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeConfirmModal');
            $this->emit('refreshTableFranchisingContacts');
        } else if ($contactReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Deletar',
                'description' => $contactReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeConfirmModal');
        }
    }


    public function render()
    {
        $response = new \stdClass();
        $response->contacts = $this->getContactFranchising();

        return view('livewire.tenant.franchising.contacts.table', ['response' => $response]);
    }
}

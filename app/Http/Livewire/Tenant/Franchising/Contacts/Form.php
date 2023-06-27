<?php

namespace App\Http\Livewire\Tenant\Franchising\Contacts;

use App\Http\Traits\WithModal;
use App\Repositories\ContactsFranchinsingRepository;
use Livewire\Component;
use WireUi\Traits\Actions;

class Form extends Component
{
    use Actions, WithModal;

    public $state = [
        'partner_id' => '',
        'phone' => '',
        'status' => ''
    ];

    public $contact;
    public $franchising_id;

    public function mount($franchising_id = null, $id = null)
   {
        if($franchising_id) {
            $this->franchising_id = $franchising_id;
        } elseif ($id) {

            $contactRepository = new ContactsFranchinsingRepository();
            $this->contact = $contactRepository->view($id)['data'];

            if($this->contact){
                $this->state = $this->contact->toArray();
            }
        }
    }

    public function save()
    {
        if($this->contact){
            return $this->update();
        }

        $request = $this->state;

        $contactRepository = new ContactsFranchinsingRepository();
        $contactReturnDB = $contactRepository->create($request, $this->franchising_id);

        if($contactReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Adicionado com Sucesso !',
                'description' => $contactReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal2');
            $this->emit('refreshTableFranchisingContacts');


        } else if ($contactReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $contactReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal2');
        }
    }

    public function update()
    {
        $request = $this->state;
        $partnersRepository = new ContactsFranchinsingRepository();

        $contactReturnDB = $partnersRepository->update($this->contact->id, $request);

        if($contactReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Atualizado com Sucesso !',
                'description' => $contactReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal2');
            $this->emit('refreshTableFranchisingContacts');

        } else if ($contactReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $contactReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal2');
        }
    }

    public function render()
    {
        return view('livewire.tenant.franchising.contacts.form');
    }
}

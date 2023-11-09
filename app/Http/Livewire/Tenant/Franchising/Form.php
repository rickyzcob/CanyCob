<?php

namespace App\Http\Livewire\Tenant\Franchising;

use App\Repositories\FranchisingRepository;
use App\Repositories\PartnersRepository;
use App\Repositories\UserRepository;
use App\Services\AddressService;
use App\Services\CNPJService;
use Livewire\Component;
use WireUi\Traits\Actions;

class Form extends Component
{

    use Actions;

    public $state = [
        'cnpj' => '',
        'attendant_id' => '',
        'cep' => '',
        'phone' => '',
        'phone01' => '',
        'phone02' => '',
        'whatsapp' => '',
        'status' => 'Ativo'
    ];
    public $franchising;

    public function mount($id = null)
    {
        $franchisingRepository = new FranchisingRepository();
        $feesReturnDB = $franchisingRepository->show($id)['data'];
        $this->franchising = $feesReturnDB;

        if($this->franchising){
            $this->state = $this->franchising->toArray();
            $this->state['address'] = '';
        }
    }

    public function updatedStateCnpj()
    {
        if($this->state['cnpj']){
            $cnpjService = new CNPJService();
            $cnpjServiceReturn = $cnpjService->consultCNPJ($this->state['cnpj']);

            if(isset($cnpjServiceReturn['error'])) {
                $this->notification([
                    'title'       => 'CNPJ',
                    'description' => $cnpjServiceReturn['error'],
                    'icon'        => 'error'
                ]);
            }   else {

                $this->state['razao_social'] = $cnpjServiceReturn['RAZAO SOCIAL'];
                $this->state['name'] = $cnpjServiceReturn['NOME FANTASIA'];
                $this->state['email'] = $cnpjServiceReturn['EMAIL'];
            }
        }
    }

    public function updatedStateCep()
    {
        if($this->state['cep']){
            $addressService  = new AddressService();
            $addressServiceReturn = $addressService->consultCEP($this->state['cep']);

            if($addressServiceReturn['code'] == 200) {

                $this->state['address'] = $addressServiceReturn['data']['logradouro'];
                $this->state['bairro'] = $addressServiceReturn['data']['bairro'];
                $this->state['city'] = $addressServiceReturn['data']['localidade'];
                $this->state['state'] = $addressServiceReturn['data']['uf'];
                $this->state['country'] = 'Brasil';

            } else if($addressServiceReturn['code'] == 400) {
                $this->notification([
                    'title'       => $addressServiceReturn['title'],
                    'description' => $addressServiceReturn['message'],
                    'icon'        => 'error'
                ]);
            }
        }
    }

    public function save()
    {
        if($this->franchising){
            return $this->update();
        }

        $request = $this->state;

        $partnersRepository = new FranchisingRepository();
        $partnersReturnDB = $partnersRepository->create($request);

        if($partnersReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Cadastrado com Sucesso !',
                'description' => $partnersReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTablePartners');

        } else if ($partnersReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $partnersReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }

    }

    public function update()
    {
        $request = $this->state;
        $partnersRepository = new FranchisingRepository();

        $partnersReturnDB = $partnersRepository->update($this->franchising->id, $request);

        if($partnersReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Aturalizado com Sucesso !',
                'description' => $partnersReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTablePartners');
        } else if ($partnersReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao cadastrar !',
                'description' => $partnersReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function getSelectAttendant()
    {
        $userRepository = new UserRepository();
        $userReturnDB = $userRepository->getSelectAttendantsActive()['data'];
        return $userReturnDB;
    }


    public function render()
    {
        $response = new \stdClass();
        $response->attendants = $this->getSelectAttendant();

        return view('livewire.tenant.franchising.form', ['response' => $response]);
    }
}

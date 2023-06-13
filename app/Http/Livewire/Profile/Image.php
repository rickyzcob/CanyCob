<?php

namespace App\Http\Livewire\Profile;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Image extends Component
{
    use Actions, WithFileUploads;

    public $image;

    public function mount($id = null)
    {
        $feesRepository = new UserRepository();
        $feesReturnDB = $feesRepository->show(Auth::user()->id)['data'];
        $this->fees = $feesReturnDB;

        if($this->fees){
            $this->state = $this->fees->toArray();
        }
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:1024',
        ]);
    }

    public function update()
    {

        $feesRepository = new UserRepository();

        $feesReturnDB = $feesRepository->uploadImage(Auth::user()->id, $this->image);

        if($feesReturnDB['status'] == 'success') {

            $this->notification([
                'title'       => 'Atualizado com Sucesso !',
                'description' => $feesReturnDB['message'],
                'icon'        => 'success'
            ]);
            $this->emit('closeModal');
            $this->emit('refreshTableFees');
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
        return view('livewire.profile.image');
    }
}

<?php

namespace App\Http\Livewire\Tenant\Releases;

use App\Repositories\ReleasesRepository;
use Livewire\Component;

class Releases extends Component
{
    public $historic_id;

    public function mount($id = null)
    {
        if($id){
            $this->historic_id = $id ;
        }
    }

    public function getReleasesByHistoric()
    {
        $releasesRepository = new ReleasesRepository();
        return $releasesRepository->getReleasesbyHistoric($this->historic_id)['data'];
    }

    public function render()
    {
        $response = new \stdClass();
        $response->releasesHistorics = $this->getReleasesByHistoric();

        return view('livewire.tenant.releases.releases', ['response' => $response]);
    }
}

<?php

namespace App\Http\Livewire\Agreement\Releases;

use App\Repositories\ReleasesRepository;
use Livewire\Component;

class Table extends Component
{
    public $agrrement_id;

    public function mount($id = null)
    {
        if($id){
            $this->agrrement_id = $id;
        }
    }

    public function getReleasesByAgreement()
    {
        $releasesRepository = new ReleasesRepository();
        $releasesReturnDB = $releasesRepository->getReleasesByAgreement($this->agrrement_id)['data'];

        return $releasesReturnDB;

    }

    public function render()
    {
        $response = new \stdClass();
        $response->releases = $this->getReleasesByAgreement();
        return view('livewire.agreement.releases.table', ['response' => $response]);
    }
}

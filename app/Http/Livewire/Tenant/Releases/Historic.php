<?php

namespace App\Http\Livewire\Tenant\Releases;

use App\Http\Traits\WithModal;
use App\Repositories\ReleasesRepository;
use Livewire\Component;

class Historic extends Component
{
    use WithModal;

    public $pageSize = 10;

    public $order = [
        'column' => 'id',
        'order' => 'DESC'
    ];

    public function getHistorics()
    {
        $releasesRepository = new ReleasesRepository();
        return $releasesRepository->historics($this->pageSize, $this->order)['data'];
    }

    public function render()
    {
        $response = new \stdClass();
        $response->historics = $this->getHistorics();

        return view('livewire.tenant.releases.historic', ['response' => $response]);
    }
}

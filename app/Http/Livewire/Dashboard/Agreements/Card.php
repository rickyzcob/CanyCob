<?php

namespace App\Http\Livewire\Dashboard\Agreements;

use App\Repositories\AgreementRepository;
use App\Repositories\DashboardRepository;
use Livewire\Component;

class Card extends Component
{
    public function getAgreementsByUser()
    {
        $dashboardRepository = new AgreementRepository();
        $dashboardReturnDB = $dashboardRepository->getAgreementsByUser()['data'];
        return $dashboardReturnDB;

    }
    public function render()
    {
        $response = new \stdClass();
        $response->agreements = $this->getAgreementsByUser();

        return view('livewire.dashboard.agreements.card', ['response' => $response]);
    }
}

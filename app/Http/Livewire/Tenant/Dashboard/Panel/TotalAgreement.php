<?php

namespace App\Http\Livewire\Tenant\Dashboard\Panel;

use App\Repositories\DashboardRepository;
use Livewire\Component;

class TotalAgreement extends Component
{
    public function getTotalValueAgreement()
    {
        $dashboardRepository = new DashboardRepository();
        $dashboardReturnDB = $dashboardRepository->getTotalValueAgreement();
        return $dashboardReturnDB;

    }

    public function render()
    {
        $response = new \stdClass();
        $response->amount_agreement = $this->getTotalValueAgreement();

        return view('livewire.tenant.dashboard.panel.total-agreement', ['response' => $response]);
    }
}

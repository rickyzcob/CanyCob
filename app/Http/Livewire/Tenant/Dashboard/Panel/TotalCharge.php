<?php

namespace App\Http\Livewire\Tenant\Dashboard\Panel;

use App\Repositories\DashboardRepository;
use Livewire\Component;

class TotalCharge extends Component
{
    public function getTotalValueCharges()
    {
        $dashboardRepository = new DashboardRepository();
        $dashboardReturnDB = $dashboardRepository->getTotalValueCharges();
        return $dashboardReturnDB;

    }

    public function render()
    {
        $response = new \stdClass();
        $response->amount_charge = $this->getTotalValueCharges();

        return view('livewire.tenant.dashboard.panel.total-charge', ['response' => $response]);
    }
}

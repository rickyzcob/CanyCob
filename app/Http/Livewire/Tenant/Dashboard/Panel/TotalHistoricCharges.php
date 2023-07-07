<?php

namespace App\Http\Livewire\Tenant\Dashboard\Panel;

use App\Repositories\DashboardRepository;
use Livewire\Component;

class TotalHistoricCharges extends Component
{
    public function getTotalHistoricsCharge()
    {
        $dashboardRepository = new DashboardRepository();
        $dashboardReturnDB = $dashboardRepository->getTotalHistoricsCharge();
        return $dashboardReturnDB;

    }

    public function render()
    {
        $response = new \stdClass();
        $response->total_historic = $this->getTotalHistoricsCharge();

        return view('livewire.tenant.dashboard.panel.total-historic-charges', ['response' => $response]);
    }
}

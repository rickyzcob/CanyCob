<?php

namespace App\Http\Livewire\Tenant\Dashboard\Graphs;

use App\Repositories\DashboardRepository;
use Livewire\Component;

class Phone extends Component
{
    public function getChargesByPhone()
    {
        $dashboardRepository = new DashboardRepository();
        $returnDashboardDB = $dashboardRepository->getChargesByPhone();

        return $returnDashboardDB;
    }
    public function render()
    {
        $response = new \stdClass();
        $response->chargePhones = $this->getChargesByPhone();

        return view('livewire.tenant.dashboard.graphs.phone', ['response' => $response]);
    }
}

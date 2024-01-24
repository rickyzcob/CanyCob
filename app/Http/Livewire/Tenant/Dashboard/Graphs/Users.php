<?php

namespace App\Http\Livewire\Tenant\Dashboard\Graphs;

use App\Repositories\DashboardRepository;
use Livewire\Component;

class Users extends Component
{
    public function getChargesByUser()
    {
        $dashboardRepository = new DashboardRepository();
        $returnDashboardDB = $dashboardRepository->getHistoricChargesByUser();

        return $returnDashboardDB;
    }

    public function render()
    {
        $response = new \stdClass();
        $response->charges = $this->getChargesByUser();

        return view('livewire.tenant.dashboard.graphs.users', ['response' => $response]);
    }
}

<?php

namespace App\Http\Livewire\Tenant\Dashboard\Graphs;

use App\Repositories\DashboardRepository;
use Livewire\Component;

class Whatsapp extends Component
{
    public function getChargesByWhatsapp()
    {
        $dashboardRepository = new DashboardRepository();
        $returnDashboardDB = $dashboardRepository->getChargesByWhatsapp();

        return $returnDashboardDB;
    }

    public function render()
    {
        $response = new \stdClass();
        $response->chargeWhatsapp = $this->getChargesByWhatsapp();

        return view('livewire.tenant.dashboard.graphs.whatsapp', ['response' => $response]);
    }
}

<?php

namespace App\Http\Livewire\Dashboard\Chart\Charges;

use App\Repositories\DashboardRepository;
use Livewire\Component;

class Graph extends Component
{
    public function getChargesByPhone()
    {
        $dashboardRepository = new DashboardRepository();
        $returnDashboardDB = $dashboardRepository->getChargesByPhone();

        return $returnDashboardDB;
    }

    public function getChargesByMail()
    {
        $dashboardRepository = new DashboardRepository();
        $returnDashboardDB = $dashboardRepository->getChargesByMail();

        return $returnDashboardDB;
    }

    public function getChargesByWhatsapp()
    {
        $dashboardRepository = new DashboardRepository();
        $returnDashboardDB = $dashboardRepository->getChargesByWhatsapp();

        return $returnDashboardDB;
    }

    public function render()
    {
        $response = new \stdClass();
        $response->chargePhones = $this->getChargesByPhone();
        $response->chargeEmail = $this->getChargesByMail();
        $response->chargeWhatsapp = $this->getChargesByWhatsapp();

        return view('livewire.dashboard.chart.charges.graph', ['response' => $response]);
    }
}

<?php

namespace App\Http\Livewire\Dashboard\Graphs;

use App\Repositories\DashboardRepository;
use Livewire\Component;

class Email extends Component
{
    public function getChargesByMail()
    {
        $dashboardRepository = new DashboardRepository();
        $returnDashboardDB = $dashboardRepository->getChargesByMail();

        return $returnDashboardDB;
    }

    public function render()
    {
        $response = new \stdClass();
        $response->chargeEmail = $this->getChargesByMail();

        return view('livewire.dashboard.graphs.email', ['response' => $response]);
    }
}

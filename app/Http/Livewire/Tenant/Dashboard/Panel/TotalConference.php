<?php

namespace App\Http\Livewire\Tenant\Dashboard\Panel;

use App\Repositories\DashboardRepository;
use Livewire\Component;

class TotalConference extends Component
{
    public function getTotalValueConference()
    {
        $dashboardRepository = new DashboardRepository();
        $dashboardReturnDB = $dashboardRepository->getTotalValueConference();
        return $dashboardReturnDB;

    }

    public function render()
    {
        $response = new \stdClass();
        $response->amount_conference = $this->getTotalValueConference();

        return view('livewire.tenant.dashboard.panel.total-conference', ['response' => $response]);
    }
}

<?php

namespace App\Http\Livewire\Dashboard\Chart\Proposals;

use App\Repositories\DashboardRepository;
use Livewire\Component;

class Graph extends Component
{
    public function getProposalbyChartJs()
    {
        $dashboardRepository = new DashboardRepository();
        $returnDashboardDB = $dashboardRepository->getProposalsByChart();

        return $returnDashboardDB;
    }


    public function render()
    {
        $response = new \stdClass();
        $response->chart = $this->getProposalbyChartJs();

        return view('livewire.dashboard.chart.proposals.graph', ['response' => $response]);
    }
}

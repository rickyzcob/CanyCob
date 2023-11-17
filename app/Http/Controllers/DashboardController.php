<?php

namespace App\Http\Controllers;

use App\Repositories\CoinsRepository;

class DashboardController extends Controller
{

    public function index()
    {
        $coinsRepository = new CoinsRepository();
        $coinsReturnDB = $coinsRepository->getLastCoinByHumor();

        return view('tenant.dashboard.index', compact('coinsReturnDB'));
    }
}

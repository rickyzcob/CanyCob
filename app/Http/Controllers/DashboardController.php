<?php

namespace App\Http\Controllers;

use App\Repositories\CoinsRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $coinsRepository = new CoinsRepository();
        $coinsReturnDB = $coinsRepository->getLastCoinByHumor();

        return view('dashboard.index',compact('coinsReturnDB'));
    }
}

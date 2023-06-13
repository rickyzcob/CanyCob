<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailsChargesCrontroller extends Controller
{
    public function show($reference = null)
    {
        return view ('charges.view', compact('reference'));
    }
}

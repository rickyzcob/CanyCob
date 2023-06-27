<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailsChargesCrontroller extends Controller
{
    public function show(Request $request)
    {
        $reference = $request->reference;

        return view ('tenant.charges.view', compact('reference'));
    }
}

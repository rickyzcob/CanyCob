<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgreementController extends Controller
{
    public function show($subdomain = null, $reference = null)
    {
        return view ('tenant.agreement.view', compact('reference'));
    }
}

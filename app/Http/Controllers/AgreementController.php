<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgreementController extends Controller
{
    public function show($reference = null)
    {
        return view ('agreement.view', compact('reference'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Proposals;
use Illuminate\Http\Request;

class ProposalChargesController extends Controller
{
    public function show(Request $request)
    {
        $proposal = Proposals::query()->where('reference', $request->reference)->first();

        if(request()->getHost() == 'projeto-cobranca'){
            $proposalUpdate = Proposals::query()->where('reference', $request->reference)->update([
                'vizualized' => 'Sim'
            ]);
        }

        return view ('tenant.proposal.view', compact('proposal'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Proposals;
use Illuminate\Http\Request;

class ProposalChargesController extends Controller
{
    public function show($reference = null)
    {
        $proposal = Proposals::query()->where('reference', $reference)->first();

        if(request()->getHost() == 'projeto-cobranca'){
            $proposalUpdate = Proposals::query()->where('reference', $reference)->update([
                'vizualized' => 'Sim'
            ]);
        }

        return view ('proposal.view', compact('proposal'));
    }
}

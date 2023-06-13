<?php

namespace App\Http\Controllers;

use App\Models\ProposalAccept;


class PorposalFormalizedController extends Controller
{
    public function show($reference = null)
    {
        $proposal = ProposalAccept::query()->where('reference', $reference)->first();

        return view ('proposal.formalized', compact('proposal'));
    }
}

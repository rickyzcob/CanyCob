<?php

namespace App\Http\Controllers;

use App\Models\ProposalAccept;


class PorposalFormalizedController extends Controller
{
    public function show($subdomain = null, $reference = null)
    {
        $proposal = ProposalAccept::query()->where('reference', $reference)->first();

        return view ('tenant.proposal.formalized', compact('proposal'));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalAccept extends Model
{
    use HasFactory;

    protected $fillable = ['reference', 'name', 'template_proposal_id', 'charge_id', 'partner_id', 'inflow', 'balance_value', 'installments', 'installment_value',
        'amount_corrected', 'content', 'vizualized', 'status', 'url', 'days', 'accept'];

    public function templateproposal()
    {
        return $this->belongsTo(TemplateProposal::class, 'template_proposal_id');
    }

    public function templateproposalFormal()
    {
        return $this->belongsTo(TemplateProposal::class, 'template_proposal_id')->where('type', 'Formal');
    }

    public function partner()
    {
        return $this->belongsTo(Partners::class);
    }

    public function charge()
    {
        return $this->belongsTo(Charges::class);
    }
}

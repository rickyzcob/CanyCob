<?php

namespace App\Models;

use App\Observers\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charges extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = ['reference', 'franchising_id', 'attendant_id', 'proposal_accept_id', 'agreement_id', 'total_amount', 'patyment_code', 'total_amount_corrected', 'notes', 'imported', 'status_id', 'concluded', 'agreement'];

    public function attendant()
    {
        return $this->belongsTo(User::class, 'attendant_id');
    }

    public function franchising()
    {
        return $this->belongsTo(Franchisings::class);
    }

    public function releases()
    {
        return $this->hasMany(Releases::class, 'charge_id');
    }

    public function status()
    {
        return $this->belongsTo(ChargeStatus::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposals::class, 'charge_id');
    }
    public function historics()
    {
        return $this->hasMany(ChargeHistoric::class, 'charge_id');
    }

    public function totalHistorics()
    {
        return $this->hasMany(ChargeHistoric::class, 'charge_id');
    }

    public function proposalAccept()
    {
        return $this->belongsTo(ProposalAccept::class, 'proposal_accept_id');
    }

    public function agreementByCharge()
    {
        return $this->belongsTo(Agreements::class, 'agreement_id');
    }
}

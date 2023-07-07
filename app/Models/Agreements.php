<?php

namespace App\Models;

use App\Observers\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agreements extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = ['reference', 'type', 'user_id', 'charge_id', 'franchising_id', 'partner_id', 'status_id', 'generate_document', 'agreements_amount', 'inflow', 'balance', 'installment_value', 'due_date', 'installments', 'fine', 'json_document', 'signatory_document', 'sent', 'traffic_ticket', 'file'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function franchising()
    {
        return $this->belongsTo(Franchisings::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partners::class);
    }

    public function charge()
    {
        return $this->belongsTo(Charge::class);
    }

    public function status()
    {
        return $this->belongsTo(AgreementStatus::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agreements extends Model
{
    use HasFactory;

    protected $fillable = ['reference', 'user_id', 'franchising_id', 'partner_id', 'status_id', 'generate_document', 'agreements_amount', 'inflow', 'balance', 'installment_value', 'due_date', 'installments', 'fine', 'json_document', 'signatory_document', 'sent', 'traffic_ticket'];

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

    public function status()
    {
        return $this->belongsTo(AgreementStatus::class);
    }
}

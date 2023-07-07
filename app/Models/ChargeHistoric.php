<?php

namespace App\Models;

use App\Observers\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeHistoric extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = ['charge_id', 'partner_id',  'name', 'datetime', 'phone', 'email', 'type', 'success', 'description', 'origin', 'date_schedule', 'date_conference'];

    public function charge()
    {
        return $this->belongsTo(Charges::class);
    }
}

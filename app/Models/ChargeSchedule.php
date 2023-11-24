<?php

namespace App\Models;

use App\Observers\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeSchedule extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = ['tenant_id', 'user_id', 'charge_id', 'charge_historic_id', 'title', 'start', 'imported', 'charged'];

    public function charge()
    {
        return $this->belongsTo(Charges::class);
    }

    public function historic()
    {
        return $this->belongsTo(ChargeHistoric::class, 'charge_historic_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

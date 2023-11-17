<?php

namespace App\Models;

use App\Observers\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeSchedule extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = ['tenant_id', 'user_id', 'charge_id', 'title', 'start', 'backgroundColor'];

    public function charge()
    {
        return $this->belongsTo(Charges::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

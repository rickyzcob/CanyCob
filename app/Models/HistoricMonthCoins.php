<?php

namespace App\Models;

use App\Observers\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricMonthCoins extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = ['tenant_id', 'user_id', 'coins', 'date', 'automatic'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}

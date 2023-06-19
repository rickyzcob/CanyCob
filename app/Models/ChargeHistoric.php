<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeHistoric extends Model
{
    use HasFactory;

    protected $fillable = ['charge_id', 'partner_id',  'name', 'datetime', 'phone', 'email', 'type', 'success', 'description', 'origin', 'date_schedule'];

    public function charge()
    {
        return $this->belongsTo(Charges::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeAmountReleases extends Model
{
    use HasFactory;

    protected $fillable = ['charge_id', 'type_release_id', 'value', 'value_corrected'];

    public function charge()
    {
        return $this->belongsTo(Charges::class);
    }
    public function typeRelease()
    {
        return $this->belongsTo(TypeReleases::class);
    }
}

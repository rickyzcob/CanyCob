<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnersFranchisings extends Model
{
    use HasFactory;

    protected $fillable = ['franchising_id', 'partner_id'];

    public function partner()
    {
        return $this->belongsTo(Partners::class);
    }

    public function franchising()
    {
        return $this->belongsTo(Franchisings::class);
    }
}

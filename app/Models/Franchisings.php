<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Franchisings extends Model
{
    use HasFactory;

    public function statusFran()
    {
        return $this->belongsTo(FranchisingStatuses::class, 'status_id');
    }

    public function attendant()
    {
        return $this->belongsTo(User::class, 'attendant_id');
    }

    public function releases()
    {
        return $this->hasMany(Releases::class, 'franchising_id');
    }

    public function partners()
    {
        return $this->hasMany(PartnersFranchisings::class, 'franchising_id');
    }
}

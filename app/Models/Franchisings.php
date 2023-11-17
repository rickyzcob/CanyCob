<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Franchisings extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id', 'attendant_id', 'status_id', 'name', 'corporate_name', 'employer_number', 'state_registration', 'zip_code',
        'address', 'number', 'complement', 'state', 'city', 'neighborhood', 'region', 'google_maps', 'country',  'phone01',
        'phone02', 'whatsapp', 'site', 'email', 'email_site', 'description', 'image', 'status'
    ];

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

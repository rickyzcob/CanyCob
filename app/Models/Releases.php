<?php

namespace App\Models;

use App\Observers\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Releases extends Model
{
    use HasFactory;

    protected $fillable = ['tenant_id', 'type',  'bill', 'type_release_id', 'name', 'employer_number', 'franchising_id', 'status_id', 'charge_id', 'charge_amount_release_id', 'agreement_id', 'account', 'issue_date', 'due_date', 'parcel', 'emp_tp_processo',
        'month', 'amount', 'amount_corrected', 'amount_paid', 'recurrent', 'imported', 'franchisee', 'notes'];

    public function franchising()
    {
        return $this->belongsTo(Franchisings::class);
    }

    public function status()
    {
        return $this->belongsTo(ReleaseStatuses::class);
    }

    public function agreement()
    {
        return $this->belongsTo(Agreement::class);
    }

    public function charge()
    {
        return $this->belongsTo(Charges::class, 'charge_id');
    }

    public function typeRelease()
    {
        return $this->belongsTo(TypeReleases::class);
    }
}

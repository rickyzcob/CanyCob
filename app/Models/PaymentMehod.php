<?php

namespace App\Models;

use App\Observers\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMehod extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = ['type_release_id', 'type', 'code', 'bank', 'agency', 'count', 'bill', 'status'];

    public function typeRelease()
    {
        return $this->belongsTo(TypeReleases::class);
    }
}

<?php

namespace App\Models;

use App\Observers\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClickSign extends Model
{
    use HasFactory, TenantTrait;
    protected $fillable = ['tenant_id', 'token', 'host', 'template_document'];

}

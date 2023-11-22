<?php

namespace App\Models;

use App\Observers\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeReleases extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = ['name', 'color', 'status'];
}

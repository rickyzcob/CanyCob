<?php

namespace App\Models;

use App\Observers\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Partners extends Model
{
    use HasFactory, TenantTrait, Notifiable;

    protected $fillable = ['name', 'phone', 'email', 'json_document', 'cpf'];
}

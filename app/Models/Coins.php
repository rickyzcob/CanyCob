<?php

namespace App\Models;

use App\Observers\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coins extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = ['user_id', 'type', 'humor', 'coins', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id', 'color', 'text_color', 'goals_coins', 'value_agreement', 'status', 'scope', 'subdomain', 'logo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = ['corporate_name', 'name', 'state_registration', 'entities_number', 'document', 'zip_code', 'address', 'number', 'complement', 'neighborhood', 'city', 'uf', 'user_id', 'color', 'text_color', 'goals_coins', 'value_agreement', 'status', 'scope', 'subdomain', 'logo', 'type_agreement'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clickSign()
    {
        return $this->hasMany(ClickSign::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Franchisings extends Model
{
    use HasFactory;

    protected $fillable = ['tenant_id', 'user_id', 'attendant_id', 'status_id', 'termination_id', 'sale_id', 'name', 'supervisor', 'address', 'number', 'complement',
        'cep', 'state', 'city', 'bairro', 'regiao', 'google_maps', 'populacao', 'cluster', 'country', 'razao_social', 'cnpj', 'cro', 'insc', 'responsavel_tecnico',
        'responsavel_tecnico_cro', 'phone01', 'phone02', 'whatsapp', 'site', 'email', 'email_site', 'description', 'image', 'status'];

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

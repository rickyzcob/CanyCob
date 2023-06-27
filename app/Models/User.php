<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Observers\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, TenantTrait, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'type',
        'coins',
        'image',
        'phone',
        'document',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function historicImportReleases()
    {
        return $this->hasMany(ImportReleasesHistoric::class);
    }

    public function historicCharge()
    {
        return $this->hasMany(ChargeHistoric::class);
    }

    public function agreements()
    {
        return $this->hasMany(Agreements::class);
    }

    public function coins()
    {
        return $this->hasMany(Coins::class);
    }

    public function role()
    {
        return $this->belongsTo(Roles::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    public function setPasswordAttribute($password)
    {
        if ( $password !== null & $password !== "" )
        {
            $this->attributes['password'] = bcrypt($password);
        }
    }
}

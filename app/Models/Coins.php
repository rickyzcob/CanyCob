<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coins extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type', 'humor', 'coins', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configurations extends Model
{
    use HasFactory;

    protected $fillable = ['logo', 'name', 'color', 'text_color', 'goals_coins', 'value_agreement'];
}

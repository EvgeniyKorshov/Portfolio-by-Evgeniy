<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dadata extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'inn',
        'ogrn',
        'manager_post',
        'manager_name',
        'email',
        'phone',
        'full_address',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Add necessary casting for password or other sensitive data
    protected $hidden = [
        'password',
        'remember_token',
    ];
}

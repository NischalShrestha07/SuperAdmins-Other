<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'phone', 'companyName', 'email', 'password', 'role_id'];

    // Add necessary casting for password or other sensitive data
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}

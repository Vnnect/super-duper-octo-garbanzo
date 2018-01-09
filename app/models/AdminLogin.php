<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
//Class which implements Illuminate\Contracts\Auth\Authenticatable
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminLogin extends Authenticatable
{
    protected $fillable = ['email', 'password'];
}

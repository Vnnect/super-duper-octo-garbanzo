<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class IsSubOrNo extends Model
{
 
    protected $hidden = array('created_at', 'updated_at');
    protected $fillable = [
        'name',
        'value',
    ];
}

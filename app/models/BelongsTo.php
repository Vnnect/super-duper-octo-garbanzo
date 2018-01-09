<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class BelongsTo extends Model
{
    protected $table = 'belongs_tos';    
    protected $hidden = array('created_at', 'updated_at');
    protected $fillable = [
        'vendor_id',
        'sub_vendor_id',
    ];
}

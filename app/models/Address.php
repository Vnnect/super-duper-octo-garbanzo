<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = pg_tbl_address;
    protected $hidden = array('created_at', 'updated_at');
    protected $fillable = array(
        'street',
        'addressline1',
        'addressline2',
        'city',
        'pincode',
        'state',
        'country',
        'landmark',
    );
}

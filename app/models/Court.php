<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{

    protected $table = pg_tbl_court;
    protected $hidden = array('created_at', 'updated_at');
    protected $fillable = array('name', 'location_code', 'venue_id', 'land_mark', 'location_map');

}

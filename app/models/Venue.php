<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $table = pg_tbl_venue;
    protected $hidden = array('created_at', 'updated_at');
    protected $fillable = array('name', 'code', 'address_id');

    public function fi(){
        return static::query()->find();
    }

}

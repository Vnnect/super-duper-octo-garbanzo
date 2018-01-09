<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FoodCat extends Model
{
    protected $table = pg_tbl_foodcat;
    protected $hidden = array('created_at', 'updated_at');
    protected $fillable = array('name', 'active');

}

<?php

namespace App\models;


use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    protected $table = pg_tbl_fooditem;
    protected $hidden = array('created_at', 'updated_at');
    protected $fillable = [
        'name',
        'code',
        'foodcat_id',
        'desc',
        'img_rep'
    ];
}

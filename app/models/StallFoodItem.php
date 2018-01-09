<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class StallFoodItem extends Model
{
    protected $table = pg_tbl_stall_food_item;
    protected $hidden = array('created_at', 'updated_at');
    protected $fillable = array(
        'name',
        'foodcat_id',
        'unit_price',
        'available_days',
        'active',
        'desc',
        'img',
        'stall_id'
    );
//'stall_id',: this cannot be changed when updating
    public function Stall()
    {
        return $this->belongsTo('App\models\Stall');
    }

    public static function getExcerpt($str, $startPos = 0, $maxLength = 50) {
        if(strlen($str) > $maxLength) {
            $excerpt   = substr($str, $startPos, $maxLength - 6);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt   = substr($excerpt, 0, $lastSpace);
            $excerpt  .= ' [...]';
        } else {
            $excerpt = $str;
        }

        return $excerpt;
    }

     public function setActiveAttribute($value)
    {
            $this->attributes['active'] = ($value=='on')?($value=1):($value=0);
    }
}

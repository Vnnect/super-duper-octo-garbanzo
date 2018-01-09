<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Stall extends Model
{

    protected $table = pg_tbl_stall;
    protected $hidden = array('created_at', 'updated_at');
    protected $fillable = array(
        'stall_no',
        'court_id',
        'vendor_id',
        'open_today' ,
        'working_days',
        'working_hours',
        'working_hours_am',
        'working_hours_pm',
        'todays_special'
    );

    public function setOpenTodayAttribute($value)
    {
            $this->attributes['open_today'] = ($value=='on')?($value=1):($value=0);
    }

    public function Vendor(){
        return $this->belongsTo('App\models\Vendor');
    }
}

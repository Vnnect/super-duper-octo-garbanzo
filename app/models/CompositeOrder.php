<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CompositeOrder extends Model
{

    protected $table = pg_tbl_composite_order;
    protected $hidden = array('created_at', 'updated_at');
    protected $fillable = [
        'code',
        'order_amt',
        'order_date',
        'status',
        'proc_status',
        'delivery_date',
        'delivery_time',
        'spl_instructions',
        'user_id'
    ];

    public function StallOrders(){
        return $this->hasMany('\App\models\StallOrder', 'composite_order_id', 'id');
    }

    public function User(){
        return $this->belongsTo('\App\models\User');
    }


}

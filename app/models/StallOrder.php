<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class StallOrder extends Model
{

    protected $table = pg_tbl_stall_order;
    protected $hidden = array('created_at', 'updated_at');

    protected $fillable = [
        'composite_order_id',
        'code',
        'stall_order_amt',
        'orderdate',
        'delivery_date',
        'delivery_time',
        'stall_id',
        'spl_instructions',
        'proc_status'
    ];

    public function StallOrderItems()
    {
        return $this->hasMany('App\models\StallOrderItem', 'stall_order_id', 'id');
    }
}

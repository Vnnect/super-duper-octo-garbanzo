<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class StallOrderItem extends Model
{
    protected $table = pg_tbl_stall_order_item;
    protected $hidden = array('created_at', 'updated_at');
    protected $fillable = [
        'stall_order_id',
        'composite_order_id',
        'stall_food_item_id',
        'quantity',
        'unit_price',
        'item_total_amt'
    ];
}

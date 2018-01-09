<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = pg_tbl_payments;
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = array(
        'comp_order_id',
        'comp_order_code',
        'trans_amt',
        'trans_id',
        'trans_date',
        'trans_status',
        'trans_tag',
        'bank_message'
    );

}

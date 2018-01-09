<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = pg_tbl_vendor;

    protected $hidden = array('created_at', 'updated_at');
    protected $fillable = array(
        'bank_account_no',
        'bank_account_name',
        'account_type',
        'name',
        'code',
        'active',
        'verified',
        'verified_date',
        'address_id',
        'pancard_no',
        'phone_no',
        'contact_person',
        'contact_email');


        public function setActiveAttribute($value)
            {
                $this->attributes['active'] = ($value=='on')?($value=1):($value=0);
            }

        public function setVerifiedAttribute($value)
            {
                $this->attributes['verified'] = ($value=='on')?($value=1):($value=0);
            }

}
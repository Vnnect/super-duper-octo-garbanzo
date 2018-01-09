<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

//Class which implements Illuminate\Contracts\Auth\Authenticatable
use Illuminate\Foundation\Auth\User as Authenticatable;

class SubVendorLogin extends Authenticatable
{
    protected $table = 'pg_sub_vendor_logins';

	    //Mass assignable attributes
	  protected $fillable = [
	    'name',
	     'email',
	      'password',
	      'sub_vendor_id',
	       'vendor_id',
	       'sub_vendor_address_id',
	        'sub_vendor_venue_id',
	         'sub_vendor_court_id',
	          'sub_vendor_stall_id',
	           'is_ven_or_sub'
	];

	//hidden attributes
	 protected $hidden = [
	     'password', 'remember_token',
	 ];

	 //belongs to only one vendor
	 public function vendor()
	 {
	 	return $this->belongsTo(VendorLogin::class); 
	 }

}

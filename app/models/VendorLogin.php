<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

//Class which implements Illuminate\Contracts\Auth\Authenticatable
use Illuminate\Foundation\Auth\User as Authenticatable;
use \App\models\SubVendorLogin;

class VendorLogin extends Authenticatable
{
	 protected $table = 'pg_vendor_logins';
	   
	    //Mass assignable attributes

	  protected $fillable = [
	    'name', 'email', 'password','vendor_id', 'vendor_address_id', 'belongs_to_vendor_id', 'vendor_venue_id', 'vendor_court_id', 'vendor_stall_id', 'is_ven_or_sub'
	];

	//hidden attributes
	 protected $hidden = [
	     'password', 'remember_token',
	 ];


	 //vendor has many sub vendors
	 public function sub_vendor()
	 {
	 	return $this->hasMany(SubVendorLogin::class,'vendor_id');
	 }


}

//vendor_id
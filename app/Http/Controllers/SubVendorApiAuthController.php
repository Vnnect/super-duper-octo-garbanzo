<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTExceptions;
use Config;
use \App\models\SubVendorLogin;

class SubVendorApiAuthController extends Controller
{
    public function authenticate()
    {
    	//get users data
    	//check if users creadiaintals are correct
    	//generate a token

    	$credentials = request()->only('email', 'password');


    	try
    	{
    		Config::set('auth.providers.users.model', \App\models\SubVendorLogin::class);

    		$token = JWTAuth::attempt($credentials);

    		if(!$token){
    			return response()->json(['error' => 'invalid_credentails'], 401);
    		}
    	}

    	catch(JWTExceptions $e)
    	{
    		return response()->json(['error' => 'something_went_wrong'], 500);
    	}

    		// $stall_email = $credentials;

    	$stall_id = $this->returnstall($credentials);
    	// return response()->json(['token' => $token], 200);
    	return response()->json(['stall_id' => $stall_id], 200);


    }

    ###################################################################################
    //  here we take the email and check the unique email and give out the model

    public function returnstall($stall)
    {
   		 $stall_email = $stall['email'];

    	$stall_id = SubVendorLogin::select('sub_vendor_stall_id')->where('email', $stall_email)->first();
    	
        $stall_id_main= $stall_id['sub_vendor_stall_id'];
    	return $stall_id_main;
    }
}

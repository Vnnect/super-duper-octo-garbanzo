<?php

namespace App\Http\Controllers\VendorAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\models\VendorLogin;
use App\models\SubVendorLogin;
use App\models\Address;
use App\models\Venue;
use App\models\Court;


use Illuminate\Support\Facades\Auth;


//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class VendorLoginController extends Controller
{

    protected $user;

    protected $redirectTo = '/vendor_home';
     //Trait
     use AuthenticatesUsers;


     protected function guard()
     {
         return Auth::guard('web_main_vendor');
     }


     public function showLoginForm()
     {
         return view('vendor_login.auth.login');
     }
    

    // To check if its main_vendor or sub_vendor

     protected function credentials(Request $request)
     {
        return ['email'=>$request->{$this->username()},'password'=>$request->password,'is_ven_or_sub'=>'0'];
     }

    // After authencation of the user we come to this method
     protected function authenticated(Request $request, $user)
    {


         $vendor = \App\models\VendorLogin::find($user->vendor_id)['sub_vendor'];
         $main_vendor = $user;


         //getting techpark name
         $venue = \App\models\Venue::find($main_vendor->vendor_id);


         //getting court name
        $court = \App\models\Court::find($main_vendor->vendor_court_id);

         $address = \App\models\Address::find($main_vendor->vendor_address_id);


        if ($vendor){
        // return redirect()->route('vendor_home', ['vendor_id' => $user->vendor_id, 'sub_vendors' => ['$vendor']]);

            return view('vendor_login.vendor_home',compact('vendor'), compact('main_vendor'));
    
            throw new Exception('Vendor is missing!');
        } else {
            
            $vendor=0;

            return view('vendor_login.vendor_home',compact('vendor','venue', 'court', 'address'),compact('main_vendor'));

        }

     
    }
   
}

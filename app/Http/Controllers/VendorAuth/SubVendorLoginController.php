<?php

namespace App\Http\Controllers\VendorAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

use App\models\SubVendorLogin;
use App\models\Address;
use App\models\Venue;
use App\models\Court;
use App\models\VendorLogin;



class SubVendorLoginController extends Controller
{
    protected $redirectTo = '/sub_vendor_home';
     //Trait
     use AuthenticatesUsers;


     protected function guard()
     {
         return Auth::guard('web_sub_vendor');
     }


     public function showLoginForm()
     {
         return view('vendor_login.auth.sub_login');
     }
    

    // To check if its main_vendor or sub_vendor

     protected function credentials(Request $request)
     {
        return ['email'=>$request->{$this->username()},'password'=>$request->password,'is_ven_or_sub'=>'1'];
     }

      // After authencation of the user we come to this method
     protected function authenticated(Request $request, $user)
    {
        $main_sub_vendor = \App\models\SubVendorLogin::find($user->id);
          $sub_vendor=$user;

               $main_vendor = $user;

    
             
         // $vendor = \App\models\VendorLogin::find($main_vendor->vendor_id);

         $parent_vendor = \App\models\VendorLogin::find($main_vendor->vendor_id);




         //getting techpark name
         $sub_vendor_venue = \App\models\Venue::find($sub_vendor->sub_vendor_id);


         //getting court name
        $sub_vendor_court = \App\models\Court::find($sub_vendor->sub_vendor_court_id);

         $sub_vendor_address = \App\models\Address::find($sub_vendor->sub_vendor_address_id);
     

            if($main_sub_vendor)
            {
          
            return view('vendor_login.sub_vendor_home',compact('sub_vendor', 'sub_vendor_venue', 'sub_vendor_court', 'sub_vendor_address', 'parent_vendor'));  
            }

    }

}

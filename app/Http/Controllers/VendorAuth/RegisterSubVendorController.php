<?php

namespace App\Http\Controllers\VendorAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Auth Facade used in guard
use Auth;


//Validator facade used in validator method
use Illuminate\Support\Facades\Validator;
use \App\lib;

use App\models\VendorLogin;
use App\models\SubVendorLogin;
use App\models\Address;
use App\models\Vendor;
use App\models\Venue;
use App\models\Stall;
use App\models\Court;
use App\models\BelongsTo;
use App\models\IsSubOrNo;


class RegisterSubVendorController extends Controller
{
    
    protected $redirectPath = 'vendor_home';


    //register form the vendor
    public function showRegistrationForm()
    {
        $address_drop= Address::all();
        $vendor_drop= Vendor::all();        
        $venue_drop = Venue::all();  
        $stall_drop = Stall::all();        
        $court_drop = Court::all();          
        $sub_or_dropper =  IsSubOrNo::all();     
        return view('vendor_login.auth.sub_register')->with([

        'court_dropper'=>$court_drop, 
        'vendor_dropper'=>$vendor_drop,
        'address_dropper'=>$address_drop,
        'stall_dropper'=>$stall_drop,
        'venue_dropper'=>$venue_drop,
        'sub_or_dropper'=>$sub_or_dropper,
             
        ]);
  
    }

    public function register(Request $request)
    {
                 //Validates data
             //    $this->validator($request->all())->validate();
         
                //Create seller
                 $sub_vendor_login = $this->create($request->all());
               
         
                 //Authenticates seller
                $this->guard()->login($sub_vendor_login);
         
                return 'sub vendor login register is completed';

              

    }

 //Validates user's Input
    // protected function Validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => 'required|max:255',
    //         'email' => 'required|email|max:255|unique:pg_vendor_logins',
    //         'password' => 'required|min:6|confirmed',
    //         'vendor_id' => 'required|numeric|digits_between:1,10' . '|exists:' . pg_tbl_vendor . ',id',
    //         'vendor_address_id' => 'required|numeric|digits_between:1,10' . '|exists:' . pg_tbl_address . ',id',
    //         'vendor_venue_id' => 'required|numeric|digits_between:1,10' . '|exists:' . pg_tbl_venue . ',id',
    //         'vendor_court_id' => 'required|numeric|digits_between:1,10' . '|exists:' . pg_tbl_court . ',id',
    //         'vendor_stall_id'=> 'required|numeric|digits_between:1,10' . '|exists:' . pg_tbl_stall . ',id',
    //         'is_ven_or_sub' => 'required|numeric|digits_between:1,10' . '|exists:' . 'belongs_tos' . ',id',
    //         // belongs too if = 0 it is main_vendor and if it is 1 it is sub_vendor
    //     ]);
    // }

     //Create a new seller instance after a validation.
     public function create(array $data)
     {
         return SubVendorLogin::create([
             'name' => $data['name'],
             'email' => $data['email'],
             'password' => bcrypt($data['password']),
             'sub_vendor_id'=>$data['sub_vendor_id'] ,
             'vendor_id'=>$data['vendor_id'] ,
             'sub_vendor_address_id' => $data['sub_vendor_address_id'] ,
             'sub_vendor_venue_id' => $data['sub_vendor_venue_id'],
             'sub_vendor_court_id' => $data['sub_vendor_court_id'],
             'sub_vendor_stall_id' => $data['sub_vendor_stall_id'],
             'is_ven_or_sub' => $data['is_ven_or_sub'],
         ]);
     }

      //Get the guard to authenticate Seller
   protected function guard()
   {
       return Auth::guard('web_sub_vendor');   
   }
}

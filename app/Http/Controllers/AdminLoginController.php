<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use \App\lib;
use \App\models\Vendor;


//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AdminLoginController extends Controller
{
   protected $user;

    protected $redirectTo = '/display_vendor';
     //Trait
     use AuthenticatesUsers;


     protected function guard()
     {
         return Auth::guard('admin_login');
     }


     public function showLoginForm()
     {
         return view('admin.admin_login');
     }

     protected function credentials(Request $request)
     {
        return ['email'=>$request->{$this->username()},'password'=>$request->password];
     }
      protected function authenticated(Request $request, $user)
    {

        $data['data'] = DB::table('pg_vendor')->get();    
        
        if(count($data) > 0)
        {
            return view('vendor.display_vendor',$data);
        }
        else 
        {
            return view('vendor.display_vendor');
        }
    }

    
}

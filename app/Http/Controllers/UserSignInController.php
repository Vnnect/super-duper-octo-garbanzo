<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTExceptions;
use Illuminate\Support\Facades\Input;
use Hash;
use Response;
use Config;
use User;
use Auth;

class UserSignInController extends Controller
{
	 public function authenticate()
    {
	    $credentials = Input::only('email', 'password');

	    if (!$token = JWTAuth::attempt($credentials)) {
	        return Response::json(false, \Illuminate\Http\Response::HTTP_UNAUTHORIZED);
	    }

	    $getuser=Auth::user(); //return back user details
	    return Response::json(compact('token', 'getuser'));
	}
}

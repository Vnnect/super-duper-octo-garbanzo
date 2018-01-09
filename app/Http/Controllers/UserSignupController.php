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

class UserSignupController extends Controller
{
    public function signup()
    {
    	$credentials = Input::only('email', 'name', 'password', 'img', 'phone');

    try {
        $credentials['password'] = Hash::make($credentials['password']);
        $user = \App\User::create($credentials);

    } catch (\Illuminate\Database\QueryException $qe) {
        return Response::json(['error' => $qe->getMessage()], \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
    } catch (Exception $e) {
        return Response::json(['error' => 'User already exists.'], \Illuminate\Http\Response::HTTP_CONFLICT);
    }

    $token = JWTAuth::fromUser($user);
    return Response::json(compact('token', 'credentials')); //return back registered with details
    }
}

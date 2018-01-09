<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Socialize;
use Auth;
use Exception;

class ApiAuthController extends Controller
{

    //use AuthenticatesUsers, RegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function redirectToFacebook()
    {
        $halt = true;
        //return Socialize::driver('facebook')->redirect();
        return Socialize::with('facebook')->redirect();
        //return redirect('http://www.scapikgo.com/api/v1/facebook/callback', 'post');
    }

    public function handleFacebookCallback()
    {
        try {
            //$user = Socialize::driver('facebook')->user();
            $user = Socialize::with('facebook')->user();
            $scapik_user = \App\User::where('email', $user->email)->first();

            if(! $scapik_user){
                $create['name'] = $user->name;
                $create['email'] = $user->email;
                $create['facebook_id'] = $user->id;
                $create['password'] = str_random(10);

                $userModel = new User;
                $createdUser = $userModel->addNew($create);
                Auth::loginUsingId($createdUser->id);
            }else{
                Auth::loginUsingId($scapik_user->id);
            }

            return redirect()->route('home');

            /*

                //OAuth Two Providers
                $token = $user->token;

                //OAuth One Providers
                $token = $user->token;
                $tokenSecret = $user->tokenSecret;

                //All Providers
                $user->getId();
                $user->getNickname();
                $user->getName();
                $user->getEmail();
                $user->getAvatar();

             */

        } catch (Exception $e) {
            //return redirect('auth/facebook'); //this creates loop
            return response("error in facebook callback url");
        }
    }
}

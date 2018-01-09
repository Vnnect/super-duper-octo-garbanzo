<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lib;
use App\User;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;
use View;
use Session;
use Redirect;

class ProfileCreationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
    {
        $profile = new lib\ProfileManager();
 
        return $profile->listAll($request, $id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       $crud = new User($request->input()) ;
     
         if($file = $request->hasFile('img')) {
            
            $file = $request->file('img') ;


            //////////////////////// file random name genrator//////////////////////////////////

                        $key = '';
                        $keys = array_merge(range(0, 9), range('a', 'z'));

                        for ($i = 0; $i < 50; $i++) {
                            $key .= $keys[array_rand($keys)];
                        }

             //////////////////////// end file random name genrator//////////////////////////////////
            // $fileName = $file->getClientOriginalName() ;
            $fileName = $key.'.jpeg';
         

            $destinationPath = '/home/scapikgo/public_html/user_profile_images/';
            $file->move($destinationPath,$fileName);
            $crud->img = 'http://scapikgo.com/user_profile_images/'.$fileName;


        

     }
        $crud->name = $request->get('name');
        $crud->email = $request->get('email');
        $crud->phone = $request->get('phone');
        $crud->password = bcrypt($request->get('password'));

        if($crud->save()){
            $status = 1;
        }else {
            $status = 0;
        }

            $data = $crud;

            return Response::json(compact('status', 'data')); 
      

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
           $crud = User::find($id);


        if($file = $request->hasFile('img')) {
            $file = $request->file('img') ;
            //////////////////////// file random name genrator//////////////////////////////////

                        $key = '';
                        $keys = array_merge(range(0, 9), range('a', 'z'));

                        for ($i = 0; $i < 50; $i++) {
                            $key .= $keys[array_rand($keys)];
                        }

             //////////////////////// end file random name genrator//////////////////////////////////
            // $fileName = $file->getClientOriginalName() ;
            
            $fileName = $key.'.jpeg';

            $destinationPath = '/home/scapikgo/public_html/user_profile_images/';
            $file->storeAs($destinationPath,$fileName );
            $file->move($destinationPath,$fileName);
            $crud->img = 'http://scapikgo.com/user_profile_images/'.$fileName;
          
     }


       $crud->name = $request->get('name');
        $crud->email = $request->get('email');
        $crud->phone = $request->get('phone');
        $crud->password = bcrypt($request->get('password'));

              if($crud->save()){
                    $status = 1;
                }else {
                    $status = 0;
                }

            
                $data = $crud;
            return Response::json(compact('status', 'data')); 
      
    
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

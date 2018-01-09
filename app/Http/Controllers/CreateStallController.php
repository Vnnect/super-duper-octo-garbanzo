<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\models\Stall;
use \App\models\Court;
use \App\models\Vendor;
use Session;
use Redirect;
use Validator;
class CreateStallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $court_drop = Court::all();  
        $vendor_drop = Vendor::all();                
        return view('vendor.stall_create')->with(['court_dropper'=>$court_drop, 'vendor_dropper'=>$vendor_drop]);
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
           $messages = [
                     'stall_no.required' => 'Please enter Stall Name or Number.',
                                          
                    ];
                         
        $validator = Validator::make($request->all(), [
            'stall_no' => 'required',
        
        ],$messages);
 
        if ($validator->fails()) {
            return redirect('new_stall')
                        ->withErrors($validator)
                        ->withInput();
        }
   


         $create_stall = new Stall($request->input()) ;
     
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

            $destinationPath = '/home/scapikgo/public_html/stall_images/';

             $file->move($destinationPath,$fileName);
             
            $create_stall->img = 'http://scapikgo.com/stall_images/'.$fileName;


     }

      $create_stall->stall_no = $request->get('stall_no');
        $create_stall->court_id = $request->get('court_id');
        $create_stall->vendor_id = $request->get('vendor_id');
        $create_stall->open_today = $request->get('open_today');
        $create_stall->vendor_id = $request->get('vendor_id');
        $create_stall->working_hours = $request->get('working_hours');
        $create_stall->todays_special = $request->get('todays_special');
        $create_stall->save();
        
       Session::flash('message', "New Stall created");
        return Redirect::back();
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
        //
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

    public function DisplayStall(){
        $stall_list = Stall::all();
        return view('vendor.display_stall')->with(['stall_list'=>$stall_list]);        
    }
}

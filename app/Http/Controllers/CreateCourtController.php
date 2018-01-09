<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use \App\models\Court;
use \App\models\Venue;
use Validator;
use View;
use Response;
use Session;
use Redirect;


class CreateCourtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venue_details = Venue::all();
        return view('vendor.court_create')->with(['venue_details'=>$venue_details]);
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
          /*This method will validate the form and store the data in database*/
   
    
          $messages = [
            'name.required' => 'Please enter the court name.',
            'venue_id.required' => 'venu not found.',
            'location_code.required' => 'Please enter your location code.',
            'land_mark.required' => 'Please enter your landmark.',                                          
   
           ];
                            
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'venue_id' => 'required|numeric|digits_between:1, 10' . '|exists:' . pg_tbl_venue . ',id',
                'location_code' => 'max:10',
                'land_mark' => 'max:30',
            ],$messages);

            if ($validator->fails()) {
            return redirect('new_court')
                        ->withErrors($validator)
                        ->withInput();
            }


// stroing value
      

         $crud = new Court($request->input()) ;
     
         if($file = $request->hasFile('location_map')) {
            
            $file = $request->file('location_map') ;
            
           //////////////////////// file random name genrator//////////////////////////////////

                        $key = '';
                        $keys = array_merge(range(0, 9), range('a', 'z'));

                        for ($i = 0; $i < 50; $i++) {
                            $key .= $keys[array_rand($keys)];
                        }

             //////////////////////// end file random name genrator//////////////////////////////////
            // $fileName = $file->getClientOriginalName() ;
            $fileName = $key.'.jpeg';

            $destinationPath = public_path().'/court_images/';

             $file->move($destinationPath,$fileName);
             
            $crud->location_map = $fileName ;


         $crud->name = $request->get('name');
        $crud->location_code = $request->get('location_code');
        $crud->venue_id = $request->get('venue_id');
        $crud->land_mark = $request->get('land_mark');


     }

        $crud->save();
        Session::flash('message', "New Court created");
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\models\Venue;
use \App\models\Address;
use Validator;
use Session;
use Redirect;

class CreateVenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = Address::all();
        return view('vendor.venue_create')->with(['address_drop'=>$address]);
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
            'name.required' => 'Please enter the techpark name.',
            'code.required' => 'Please enter the techpark code.',
            'address_id.required' => 'Address Id is invalid.',
                                                   
   
           ];
                            
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'code' => 'required|min:3|max:7',
                'address_id' => 'required|numeric|digits_between:1,10' . '|exists:' . pg_tbl_address . ',id'
            ],$messages);

            if ($validator->fails()) {
            return redirect('new_venue')
                        ->withErrors($validator)
                        ->withInput();
            }


// stroing value
     


        $crud = new Venue($request->input()) ;
     
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

            // $destinationPath = public_path().'/venue_images/';
            $destinationPath = '/home/scapikgo/public_html/venue_images/';

            $file->move($destinationPath,$fileName);

                
             $crud->img = 'http://scapikgo.com/venue_images/'.$fileName;

     }
            
     

        $crud->name = $request->get('name');
        $crud->code = $request->get('code');
        $crud->address_id = $request->get('address_id');

            $crud->save() ;

          
         
        Session::flash('message', "New Venue created");
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

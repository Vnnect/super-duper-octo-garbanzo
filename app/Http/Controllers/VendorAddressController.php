<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib;
use \App\models\Address;
use Validator;
use Session;
use Redirect;

class VendorAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vendor.address_create');        
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
                     'street.required' => 'Please enter street name.',
                     'addressline1.required' => 'Please enter your address  name.',
                     'city.required' => 'Please enter your city.',
                     'pincode.required' => 'Please enter your pincode.', 
                     'state.required' => 'Please enter your state.',                     
                     'country.required' => 'Please enter your country.',                                           
            
                    ];
                         
        $validator = Validator::make($request->all(), [
            'street' => 'required|max:150',
            'addressline1' => 'required|max:150',

            'city' => 'required|max:50',
            'pincode' => 'required|max:7',
            'state' => 'required|max:50',
            'country' => 'required|max:50',
        
        ],$messages);
 
        if ($validator->fails()) {
            return redirect('new_address')
                        ->withErrors($validator)
                        ->withInput();
        }
   

        // stroing value
        $address = new Address([
            'street' => $request->get('street'),
            'addressline1' => $request->get('addressline1'),
            'addressline2' => $request->get('addressline2'),
            'city' => $request->get('city'),
            'pincode' => $request->get('pincode'),
            'state' => $request->get('state'),
            'country' => $request->get('country'),
            'landmark' => $request->get('landmark')
        ]);

        $address->save();
        
        Session::flash('message', "New Address created");
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

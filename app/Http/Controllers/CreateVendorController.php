<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use \App\models\Vendor;
use \App\models\Venue;
use Validator;
use Session;
use Redirect;
class CreateVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $drop = Venue::all();
        return view('vendor.vendor_create')->with(['drop'=>$drop]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $drop = Venue::all();
        return view('vendor.vendor_create')->with(['drop'=>$drop]);
        
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
            'bank_account_no.required' => 'Please enter the bank account number.',
            'bank_account_name.required' => 'Please enter the bank account name.',
            'account_type.required' => 'Please enter the account type.',
            'name.required' => 'Please enter the vendor name.',
            'verified_date.required' => 'Please enter your the verfied date in YYYY-MM-DD.',     
            'address_id.required' => 'Invalid address.',                                          
            'pancard_no.required' => 'Please enter the pancard number.',                                          
            'phone_no.required' => 'Please enter the phone number.',     
            'contact_person.required' => 'Please enter contact person field.',                                                      
            'contact_email.email' => 'Please enter the correct email',                                                      
            
   
           ];
                            
            $validator = Validator::make($request->all(), [
                'bank_account_no' => "required|max:20|regex:/^[0-9]+$/",
                'bank_account_name' => 'required|max:100',
                'account_type' => 'required|max:3',
                'name' => 'required|max:20',
                'code' => 'required|min:3|max:6',
                'verified_date' => 'nullable|date|date_format:Y-m-d|after:yesterday',
                'address_id' => 'required|numeric|digits_between:1,10' . '|exists:' . pg_tbl_address . ',id',
                'pancard_no' => 'required|alpha_num|size:10',
                'phone_no' => 'required|size:10',
                'contact_person' => 'required|min:2|max:50',
                'contact_email' => 'required|email|max:70'
            ],$messages);

            if ($validator->fails()) {
            return redirect('new_vendor')
                        ->withErrors($validator)
                        ->withInput();
            }


// stroing value
        $create_vendor = new Vendor([
            'bank_account_no' => $request->get('bank_account_no') ,
            'bank_account_name' => $request->get('bank_account_name'),
            'account_type' => $request->get('account_type'),
            'name' => $request->get('name'),
            'code' => $request->get('code'),
            'active' => $request->get('active'),
            'verified' => $request->get('verified'),
            'verified_date' => $request->get('verified_date'),
            'address_id' => $request->get('address_id'),
            'pancard_no' => $request->get('pancard_no'),
            'phone_no' => $request->get('phone_no'),
            'contact_person' => $request->get('contact_person'),
            'contact_email'  => $request->get('contact_email'),
        ]);


        $create_vendor->save();

        Session::flash('message', "New Vendor created");
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

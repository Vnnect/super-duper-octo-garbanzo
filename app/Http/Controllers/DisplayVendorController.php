<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use \App\lib;
use \App\models\Vendor;
use Session;
use Redirect;

class DisplayVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vendor.display_vendor');
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
        //
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
    public function editDataForUpdate($userId)
    {
        $data = Vendor::find($userId);
        if(count($data)> 0 )
        {
                return view('vendor.vendor_edit',['data'=>$data]);
        } else 
        {
            return view('vendor.display_vendor',['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateData(Request $request)
    {
        $vendor_update = Vendor::find($request->input('userId'));

        $vendor_update->bank_account_no = $request->input('bank_account_no');
        $vendor_update->bank_account_name = $request->input('bank_account_name');
        $vendor_update->account_type = $request->input('account_type');
        $vendor_update->name = $request->input('name');
        $vendor_update->code = $request->input('code');
        $vendor_update->active = $request->input('active');
        $vendor_update->verified = $request->input('verified');
        $vendor_update->verified_date = $request->input('verified_date');
        $vendor_update->address_id = $request->input('address_id');
        $vendor_update->pancard_no = $request->input('pancard_no');
        $vendor_update->phone_no = $request->input('phone_no');
        $vendor_update->contact_person = $request->input('contact_person');
        $vendor_update->contact_email  = $request->input('contact_email');

        $vendor_update->save();

       Session::flash('message', "Vendor Updated Successfully ");
         return $this->getData();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('pg_vendor')->where('id', $id)->delete();
        Session::flash('message', "Vendor Deleted Successfully ");
        return $this->getData();
    
    }


    public function getData() 
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lib;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
    {
        $vend = new lib\VendorManager();
        return response()->json($vend->listAll($request, $id));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $rules = [
            'bank_account_no' => 'required|max:20',
            'bank_account_name' => 'required|max:100',
            'account_type' => 'required|max:2',
            'name' => 'required|max:20',
            'address_id' => 'nullable|numeric|digits_between:1,10',
            'pancard_no' => 'required|size:10',
            'phone_no' => 'required|size:10',
            'contact_person' => 'required|min:2|max:50',
            'contact_email' => 'required|email|max:70'
        ];

        $validator = Validator::make($request->json()->all(), $rules);

        if ($validator->fails()) {
            return response()->json(lib\PgResponse::ValidationFailed(pg_tbl_vendor, $validator));
        }
*/

        $vend = new lib\VendorManager();
        return response()->json($vend->insert($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vend = new lib\VendorManager();
        return response()->json($vend->update($request, $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $vend = new lib\VendorManager();
        return response()->json($vend->delete($request, $id));
    }
}

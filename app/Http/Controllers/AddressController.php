<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\lib;
use \Validator;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
    {
        $addr = new lib\AddressManager();
        return response()->json($addr->listAll($request, $id));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $rules = [
            'street' => 'required|max:150',
            'addressline1' => 'required|max:150',
            'addressline2' => 'required|max:150',
            'city_id' => 'numeric|max:10',
            'pincode' => 'required|max:7',
            'state_id' => 'numeric|max:10',
            'country_id' => 'numeric|max:10',
            'landmark' => 'max:30'
        ];

        $validator = Validator::make($request->json()->all(), $rules);

        if ($validator->fails()) {
            return response()->json(lib\PgResponse::ValidationFailed(pg_tbl_address, $validator));
        }
*/

        $addrmgr = new lib\AddressManager();
        return response()->json($addrmgr->insert($request));
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
        $addr = new lib\AddressManager();
        return response()->json($addr->update($request, $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $addr = new lib\AddressManager();
        return response()->json($addr->delete($request, $id));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Validator;
use App\lib;

class CourtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
    {
        $court = new lib\CourtManager();
        return response()->json($court->listAll($request, $id));
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
        $court = new lib\CourtManager();
        return response()->json($court->insert($request));
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
        $court = new lib\CourtManager();
        return response()->json($court->update($request, $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $court = new lib\CourtManager();
        return response()->json($court->delete($request, $id));
    }

    public function getCourtMenu($court_id)
    {
        $court = new lib\CourtManager();
        return response()->json($court->getMenu($court_id));
    }

    public function getCourtStalls($court_id){
        $stall = new lib\StallManager();
        return response()->json($stall->getCourtStalls($court_id));
    }
}

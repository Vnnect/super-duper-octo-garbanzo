<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\lib;

class StallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
    {
        $stall = new lib\StallManager();
        return response()->json($stall->listAll($request, $id));
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
        $stall = new lib\StallManager();
        return response()->json($stall->insert($request));
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
        $stall = new lib\StallManager();
        return response()->json($stall->update($request, $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $stall = new lib\StallManager();
        return response()->json($stall->delete($request, $id));
    }

    public function getStallMenu($stall_id, $menuitem_id = null)
    {
        $stall = new lib\StallManager();
        return response()->json($stall->getMenu($stall_id, $menuitem_id));

    }

    public function addStallMenuItem(Request $request, $stall_id)
    {
        $stall = new lib\StallManager();
        return response()->json($stall->addStallMenuItem($request, $stall_id));
    }

    public function updateStallMenuItem(Request $request, $stall_id, $stall_food_item_id)
    {
        $stall = new lib\StallManager();
        return response()->json($stall->updateStallMenuItem($request, $stall_id, $stall_food_item_id));
    }

    public function deleteStallMenuItem(Request $request, $stall_id, $stall_food_item_id)
    {
        $stall = new lib\StallManager();
        return response()->json($stall->deleteStallMenuItem($request, $stall_id, $stall_food_item_id));
    }

    public function getOrderHistory($stall_id){
        $stall = new lib\StallManager();
        return response()->json($stall->getOrderHistory($stall_id));
    }

}

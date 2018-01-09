<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\lib;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($code = null)
    {
        $order = new lib\OrderManager();
        return response()->json($order->listAll($code));
    }

    /**
     * retrieve a single order.
     *
     * @return \Illuminate\Http\Response
     */
    public function Order($code)
    {
        $order = new lib\OrderManager();
        return response()->json($order->getOrder($code));
    }

    /**
     * listing of the orders related to the stall.
     *
     * @return \Illuminate\Http\Response
     */
    public function stallorders($stall_id = null)
    {
        $order = new lib\OrderManager();
        return response()->json($order->getStallorders($stall_id));
    }


    // user orders history

  public function userOrders($user_id = null)
    {
        $order = new lib\OrderManager();
        return response()->json($order->getUserOrders($user_id));
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
        $order = new lib\OrderManager();
        return response()->json($order->insert($request));
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
    public function updateOrder(Request $request, $code)
    {



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * change the processing state of the stall-order to delivered
     */
    public function OrderDelivered(Request $request, $stall_id, $comp_order_id)
    {
        $order = new lib\OrderManager();
        return response()->json( $order->OrderDelivered($request, $stall_id, $comp_order_id) );
    }

    public function OrderPaymentMade(Request $request, $comp_order_id)
    {
        $order = new lib\OrderManager();
        return response()->json($order->OrderPyamentMade($request, $comp_order_id));
    }


}

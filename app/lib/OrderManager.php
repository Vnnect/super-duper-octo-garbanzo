<?php

namespace App\lib;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;
use \App\models;
use League\Flysystem\Exception;
use \Validator;
use App\lib;

class OrderManager
{


    public function listAll($comp_order_code = null)
    {

        return DB::table(pg_tbl_composite_order . ' AS co')
            ->join(pg_tbl_stall_order . ' AS so', 'co.id', '=', 'so.composite_order_id')
            ->join(pg_tbl_stall_order_item . ' AS oi', 'so.id', '=', 'oi.stall_order_id')
            ->orderby('oi.id', 'asc')
            ->get();

    }

    public function getOrder($comp_order_code)
    {

        return DB::table(pg_tbl_composite_order . ' AS co')
            ->join(pg_tbl_stall_order . ' AS so', 'co.id', '=', 'so.composite_order_id')
            ->join(pg_tbl_stall_order_item . ' AS oi', 'so.id', '=', 'oi.stall_order_id')
            ->join(pg_tbl_stall_food_item . ' AS sfi', 'oi.stall_food_item_id', '=', 'sfi.id')
            ->select(array('co.id as comp_order_id',  'co.user_id', 'co.code as order_code', 'so.code as stall_order_code', 'sfi.name as food_item_name',
                'oi.quantity as quantity', 'oi.unit_price as unit_price', 'oi.item_total_amt as item_total_amt',
                'co.order_amt as order_amt', 'so.stall_order_amt as stall_order_amt', 'co.order_date as order_date',
                'co.status as order_status', 'co.proc_status as order_proc_status', 'so.proc_status as stall_order_proc_status',
                'sfi.id as food_item_id', 'oi.id as item_id', 'so.stall_id as stall_id', 'co.spl_instructions as spl_instructions'
            ))
            ->where('co.code', $comp_order_code)
            ->orderby('oi.id', 'asc')
            ->get();


    }

    public function getStallorders($stall_id)
    {

        if (gettype((int)$stall_id) !== "integer") {
            return PgResponse::ListError('stall orders', new Exception('Stall Id is required.'));
        }

        $stall_orders = DB::table(pg_tbl_composite_order . ' AS co')
            ->join(pg_tbl_stall_order . ' AS so', 'co.id', '=', 'so.composite_order_id')
            ->join(pg_tbl_stall_order_item . ' AS oi', 'so.id', '=', 'oi.stall_order_id')
            ->join(pg_tbl_stall_food_item . ' AS sfi', 'oi.stall_food_item_id', '=', 'sfi.id')
            ->where('so.stall_id', $stall_id)
            // only orders whose payment is  made
            // ->where('so.proc_status', 2)
            ->select(
                array(
                    'co.user_id as comp_user_id','co.id as comp_order_id', 'co.code as order_code', 'so.code as stall_order_code', 'so.stall_order_amt as stall_order_amt',
                    'so.stall_id as stall_id', 'co.spl_instructions', 'co.order_date as order_date', 'co.status as order_status',
                    'so.proc_status as stall_order_proc_status', 'oi.id as item_id', 'stall_food_item_id',
                    'sfi.name as food_item_name', 'quantity', 'oi.unit_price', 'item_total_amt'
                ))
            ->orderby('co.order_date', 'desc')
            ->orderby('oi.id', 'asc')
            ->get();

        return pg_utils::reOrganizeJSONResponse($stall_orders, pg_ctx_stall_orders);

    }

      public function getUserOrders($user_id)
    {

        if (gettype((int)$user_id) !== "integer") {
            return PgResponse::ListError('stall orders', new Exception('User Id is required.'));
        }

        $stall_orders = DB::table(pg_tbl_composite_order . ' AS co')
            ->join(pg_tbl_stall_order . ' AS so', 'co.id', '=', 'so.composite_order_id')
            ->join(pg_tbl_stall_order_item . ' AS oi', 'so.id', '=', 'oi.stall_order_id')
            ->join(pg_tbl_stall_food_item . ' AS sfi', 'oi.stall_food_item_id', '=', 'sfi.id')
            ->where('co.user_id', $user_id)
            // only orders whose payment is  made
            // ->where('so.proc_status', 2)
            ->select(
                array(
                    'co.user_id as comp_user_id','co.id as comp_order_id', 'co.code as order_code', 'so.code as stall_order_code', 'so.stall_order_amt as stall_order_amt',
                    'so.stall_id as stall_id', 'co.spl_instructions', 'co.order_date as order_date', 'co.status as order_status',
                    'so.proc_status as stall_order_proc_status', 'oi.id as item_id', 'stall_food_item_id',
                    'sfi.name as food_item_name', 'quantity', 'oi.unit_price', 'item_total_amt'
                ))
            ->orderby('co.order_date', 'desc')
            ->orderby('oi.id', 'asc')
            ->take(10)->get();

        return pg_utils::reOrganizeJSONResponse($stall_orders, pg_ctx_stall_orders);

    }

    public function insert(Request $request)
    {

        try {

            $aJsonInput = array();



            if (!pg_utils::IsValidJson($request, $aJsonInput)) {

                return PgResponse::InsertJsonParseError();
            }

            $this->preProcessData($aJsonInput);
             // dd($aJsonInput);
            //create composite order
            $validation = $this->validateForInsert($aJsonInput, pg_tbl_composite_order);
            if ($validation !== TRUE) {
                return $validation;
            }

            DB::beginTransaction();
            $res = $this->CreateCompositeOrder($aJsonInput);

            if ($res === FALSE) {
                DB::rollBack();
                throw new Exception($aJsonInput['order']['error']);
            }

            //create stall order
            $validation = null;
            $validation = $this->validateForInsert($aJsonInput, pg_tbl_stall_order);
            if ($validation !== TRUE) {
                DB::rollBack();
                return $validation;
            }
            $res = $this->CreateStallOrders($aJsonInput);
            if ($res === FALSE) {
                DB::rollBack();
                throw new Exception($aJsonInput['stall_orders']['error']);
            }

            //create stall order items
            $this->assignItemsToStallOrder($aJsonInput);
            $validation = null;
            $validation = $this->validateForInsert($aJsonInput, pg_tbl_stall_order_item);
            if ($validation !== TRUE) {
                DB::rollBack();
                return $validation;
            }
            $res = $this->CreateStallOrderItems($aJsonInput);
            if ($res === FALSE) {
                DB::rollBack();
                throw new Exception($aJsonInput['order_items']['error']);
            }

            //success
            DB::commit();

            $resp = PgResponse::InsertSuccess($aJsonInput['order']['id'], array('order' => $aJsonInput['order']));

            return $resp;

        } catch (Exception $e) {
            DB::rollBack();
            return PgResponse::InsertError('Order', $e);
        }
    }//EOF

    private function preProcessData(&$aJsonInput)
    {
        $this->getStallsAndVendorsInOrder($aJsonInput);
        $this->fillNewOrderInfo($aJsonInput);
        $this->SplitIntoStallOrders($aJsonInput);
        
    } //EOF
    /*
     * @return bool
     */
    public function CreateCompositeOrder(&$aJsonData)
    {
        $CompOrder = new models\CompositeOrder();
        $CompOrder->fill($aJsonData['order']);

        if ($CompOrder->save()) {
            $aJsonData['order']['id'] = $CompOrder->id;

            foreach ($aJsonData['stall_orders'] as $k => $stlOrder) {
                $aJsonData['stall_orders'][$k]['composite_order_id'] = $CompOrder->id;
            }

            return TRUE;
        } else {
            $aJsonData['order']['error'] = "Could not create composite order";
            return FALSE;
        }

    }//EOF

    public function CreateStallOrders(&$aJsonInput)
    {

        foreach ($aJsonInput['stall_orders'] as $k => $stlOrder) {
            $StallOrder = new models\StallOrder();
            $StallOrder->fill($stlOrder);
            if ($StallOrder->save()) {
                $aJsonInput['stall_orders'][$k]['stall_order_id'] = $StallOrder->id;
                $aJsonInput['stall_orders'][$k]['stall_id'] = $StallOrder->stall_id;
                $StallOrder = null;
            } else {
                $aJsonInput['stall_orders']['error'] = "could not create stall order:" . $k;
                return FALSE;
                break;
            }
        }

        return TRUE;

    }//EOF


    public function assignItemsToStallOrder(&$aJsonData)
    {

        foreach ($aJsonData['order_items'] as $ik => $OrderItem) {

            foreach ($aJsonData['stall_orders'] as $sk => $so) {
                if ($OrderItem['stall_id'] == $so['stall_id']) {
                    $aJsonData['order_items'][$ik]['stall_order_id'] = $so['stall_order_id'];
                    $aJsonData['order_items'][$ik]['composite_order_id'] = $so['composite_order_id'];
                    break;
                }
            }
        }

        return TRUE;

    }//EOF

    /*
        * @return bool
    */
    public function CreateStallOrderItems(&$aJsonData)
    {

        foreach ($aJsonData['order_items'] as $k => $OrderItem) {
            $FoodItem = new models\StallOrderItem();
            $FoodItem->fill($OrderItem);
            if ($FoodItem->save()) {
                $aJsonData['order_items'][$k]['id'] = $FoodItem->id;
                $FoodItem = null;
            } else {
                $aJsonData['order_items']['error'] = "could not create order item:" . $k;
                return FALSE;
                break;
            }
        }

        return TRUE;

    }//EOF

    private function getStallsInOrder_bak($aJsonData)
    {
        $id_list = array();
        foreach ($aJsonData['order_items'] as $item) {
            array_push($id_list, $item['stall_id']);
        }

        $stalls = models\Stall::where('id', $id_list)->get();

        return $stalls;
    } //EOF

    private function getStallsAndVendorsInOrder(&$aJsonData)
    {
        $id_list = array();
        foreach ($aJsonData['order_items'] as $item) {
            array_push($id_list, $item['stall_id']);
        }

        $stalls = DB::table(pg_tbl_stall)->whereIn('id', $id_list)->get();

        $vendor_id_list = $stalls->pluck('vendor_id');
        $vendors = DB::table(pg_tbl_vendor)->whereIn('id', $vendor_id_list)->get();

        $aJsonData['stalls'] = $stalls;
        $aJsonData['vendors'] = $vendors;

    } //EOF

    /*
     * Split the composite order into orders for each stall (stallorder)
     * @return App\models\CompositeOrder
     */
    public function SplitIntoStallOrders(&$aJsonInput)
    {

        $orders = array();

        foreach ($aJsonInput['stalls'] as $stl) {
            $vendor_code = $aJsonInput['vendors']->where('id', $stl->vendor_id)->pluck('code')->first();
            $stall_order_code = $aJsonInput['order']['code'] . ' ' . "({$vendor_code})";
            $stallorder = array(
                'composite_order_id' => '--',   // not created yet $aJsonInput['order']['id'],
                'code' => $stall_order_code,
                'stall_order_amt' => $this->calcStallOrderAmount($aJsonInput, $stl->id),
                'orderdate' => $aJsonInput['order']['order_date'],
                'proc_status' => pg_utils::getOrderProcStatusId(pg_ord_proc_stat_new),
                'stall_id' => $stl->id
            );

            array_push($orders, $stallorder);

        }

        $aJsonInput['stall_orders'] = $orders;

    }//EOF

    public function calcStallOrderAmount(&$aJsonInput, $StallId)
    {
        $stall_order_amt = 0.00;
        foreach ($aJsonInput['order_items'] as $item) {
            if ($item['stall_id'] != $StallId) {
                continue;
            }
            $stall_order_amt = $stall_order_amt + $item['item_total_amt'];
        }

        return $stall_order_amt;
    }//EOF


    public function getRulesForInsert($strTable)
    {

        $rules = null;
        switch ($strTable) {
            case pg_tbl_composite_order:
                $order_rules = [
                    'code' => 'required|min:6|max:30',
                    'order_amt' => "required|max:16|regex:/^\d*(\.\d{1,2})?$/",
                    'order_date' => 'required|date|date_format:Y-m-d|after:yesterday',
                    'status' => 'required' . '|exists:' . pg_tbl_order_status . ',id',
                    'proc_status' => 'required' . '|exists:' . pg_tbl_order_proc_status . ',id',
                    'spl_instructions' => 'max:100',
                    'user_id' => 'required'
                ];
                $rules = $order_rules;
                break;

            case pg_tbl_stall_order:
                $stall_order_rules = [
                    'composite_order_id' => 'required' . '|exists:' . pg_tbl_composite_order . ',id',
                    'code' => 'required|min:6|max:30',
                    'stall_order_amt' => "required|min:1|max:15|regex:/^\d*(\.\d{1,2})?$/",
                    'proc_status' => 'required' . '|exists:' . pg_tbl_order_proc_status . ',id',
                    'orderdate' => 'required|date|date_format:Y-m-d|after:yesterday',
                    'stall_id' => 'required' . '|exists:' . pg_tbl_stall . ',id',
                    'spl_instructions' => 'max:100'
                ];
                $rules = $stall_order_rules;
                break;
            case pg_tbl_stall_order_item:

                $order_item_rules = [
                    'stall_order_id' => 'numeric|required|digits_between:1,10' . '|exists:' . pg_tbl_stall_order . ',id',
                    'composite_order_id' => 'numeric|required|digits_between:1,10' . '|exists:' . pg_tbl_composite_order . ',id',
                    'stall_food_item_id' => 'numeric|required|digits_between:1,10' . '|exists:' . pg_tbl_stall_food_item . ',id',
                    'quantity' => 'required|min:1|max:65535',    //mysql small int max value is 65535
                    'unit_price' => "required|max:15|regex:/^\d*(\.\d{1,2})?$/",
                    'item_total_amt' => "required|max:15|regex:/^\d*(\.\d{1,2})?$/"
                ];

                $rules = $order_item_rules;

                break;
        }

        return $rules;
    }//EOF

    public function validateForInsert(&$aJsonInput, $strTable)
    {

        switch ($strTable) {
            case pg_tbl_composite_order:
                $rules = $this->getRulesForInsert(pg_tbl_composite_order);

                $OrderData = $aJsonInput['order'];
                $validator = Validator::make($OrderData, $rules);
                if ($validator->fails()) {
                    return lib\PgResponse::ValidationFailed(pg_tbl_composite_order, $validator);
                }
                return TRUE;
                break;

            case pg_tbl_stall_order:
                $rules = $this->getRulesForInsert(pg_tbl_stall_order);
                $StallOrdersData = $aJsonInput['stall_orders'];
                foreach ($StallOrdersData as $stlOrder) {
                    $validator = Validator::make($stlOrder, $rules);
                    if ($validator->fails()) {
                        return lib\PgResponse::ValidationFailed(pg_tbl_stall_order, $validator);
                    }
                }
                return TRUE;
                break;

            case pg_tbl_stall_order_item:
                $rules = $this->getRulesForInsert(pg_tbl_stall_order_item);
                $OrderItemsData = $aJsonInput['order_items'];
                foreach ($OrderItemsData as $OrderItem) {
                    $validator = Validator::make($OrderItem, $rules);
                    if ($validator->fails()) {
                        return lib\PgResponse::ValidationFailed(pg_tbl_stall_order_item, $validator);
                    }
                }
                return TRUE;
                break;
        }


        return FALSE;

    } //EOF

    private function fillNewOrderInfo(&$aJsonInput)
    {

        // dd($aJsonInput);
        $aJsonInput['order']['code'] = $this->getNewOrderCode($aJsonInput);
        $aJsonInput['order']['order_amt'] = $this->calcOrderAmount($aJsonInput);
        $aJsonInput['order']['status'] = pg_utils::getOrderStatusId(pg_ord_stat_new);
        $aJsonInput['order']['proc_status'] = pg_utils::getOrderProcStatusId(pg_ord_proc_stat_new);
        $aJsonInput['order']['order_date'] = date("Y-m-d");
        $aJsonInput['order']['user_id'] =  $aJsonInput['order']['user_id']; //(undo)

    }//EOF

    private function calcOrderAmount(&$aJsonInput)
    {
        $ord_amt = 0.00;

        foreach ($aJsonInput['order_items'] as $k => $item) {
            $aJsonInput['order_items'][$k]['item_total_amt'] = ($item['unit_price'] * $item['quantity']);
            $ord_amt = $ord_amt + $aJsonInput['order_items'][$k]['item_total_amt'];
        }

        return $ord_amt;

    }//EOF

    private function getNewOrderCode(&$aJsonInput, $attempt_no = 1)
    {
        if ($attempt_no > 6) {
            throw new Exception("Could not generate order number. Too many tries.");
        }

        $rn = mt_rand(pg_ord_code_min, pg_ord_code_max);

        $ven = models\Venue::find($aJsonInput['order']['venue_id']);
        if ($ven->code) {
            $ordcode = trim($ven->code) . $rn;
            $order = models\CompositeOrder::query()->where('code', '=', $ordcode);
            if (property_exists($order, 'id')) {
                //order code exists because the random number already exists
                return $this->getNewOrderCode($aJsonInput, ++$attempt_no);
            } else {
                return $ordcode;
            }
        }

        return '';

    }//EOF

    public function OrderDelivered(Request $request, $stall_id, $comp_order_id)
    {

        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::UpdateJsonParseError('order');
            }

            $rows_affected = DB::table(pg_tbl_stall_order)
                ->where('composite_order_id', $comp_order_id)
                ->where('stall_id', $stall_id)
                ->update(['proc_status' => pg_utils::getOrderProcStatusId(pg_ord_proc_stat_delivered)]);

            $resp = null;

            if ($rows_affected > 0) {
                $resp = PgResponse::UpdateSuccess(null, $rows_affected);
            } else if ($rows_affected == 0) {
                $resp = PgResponse::UpdatedNone();
            } else {
                $resp = PgResponse::UpdateFailed('order');
            }

            return $resp;

        } catch (\Illuminate\Database\QueryException $e) {
            return PgResponse::UpdateError('order', $e);
        }


    }//EOF

    public function OrderPyamentMade(Request $request, $comp_order_id)
    {
        $paymentMgr = new PaymentsManager();
        return $paymentMgr->insert($request, $comp_order_id);

    }//EOF

    public function getStallOrderHistory($stall_id)
    {

        $orderhistory = DB::table(pg_tbl_composite_order . ' AS co')
            ->join(pg_tbl_stall_order . ' AS so', 'co.id', '=', 'so.composite_order_id')
            ->join(pg_tbl_stall_order_item . ' AS oi', 'so.id', '=', 'oi.stall_order_id')
            ->join(pg_tbl_stall_food_item . ' AS sfi', 'oi.stall_food_item_id', '=', 'sfi.id')
            ->select(
                'co.id as comp_order_id',
                'so.code as stall_order_code',
                'co.order_amt as order_amt',
                'co.order_date as order_date',
                'co.status as order_status',
                'so.proc_status as stall_order_proc_status',
                'so.delivery_date as delivery_date',
                'so.delivery_time as delivery_time',
                'so.stall_order_amt as stall_order_amt',
                'so.stall_id as stall_id',
                'stall_order_id',
                'stall_food_item_id',
                'quantity',
                'oi.unit_price as unit_price',
                'item_total_amt',
                'sfi.name as food_item_name'
            )
            // ->where('so.stall_id', $stall_id)->where('so.proc_status','=', 2)
            ->where(['so.stall_id' => $stall_id, 'so.proc_status' => 2])
            ->orderby('co.order_date', 'desc')
            ->take(10)
            ->get();

        return pg_utils::reOrganizeJSONResponse($orderhistory, pg_ctx_stall_orders_history);
    }//EOF

}
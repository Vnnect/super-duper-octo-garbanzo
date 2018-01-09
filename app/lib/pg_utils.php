<?php

namespace App\lib;

use \App\models;

class pg_utils
{

    private static $_OrderStats;
    private static $_OrderProcStats;

    public static function IsValidJson($request, &$aJson_Out)
    {
        $strJson = $request->getcontent();
        $aJsonContent = json_decode($strJson, true);
        $json_parse_error = json_last_error();

        if ($json_parse_error !== JSON_ERROR_NONE) {
            return FALSE;
        }

        $aJson_Out = $aJsonContent;

        return TRUE;

    }//EOF

    public static function getOrderStatusId($StatusCode)
    {
        $orderstats = self::getOrderStats();
        return $orderstats->where('code', $StatusCode)->first()->id;
    }//EOF

    public static function getOrderProcStatusId($ProcStatusCode)
    {
        $OrderProcStats = self::getOrderProcStats();
        return $OrderProcStats->where('code', $ProcStatusCode)->first()->id;
    }//EOF

    public static function getOrderStats()
    {
        if (!isset(self::$_OrderStats)) {
            self::$_OrderStats = models\OrderStatus::all();
        }
        return self::$_OrderStats;
    }//EOF

    public static function getOrderProcStats()
    {
        if (!isset(self::$_OrderProcStats)) {
            self::$_OrderProcStats = models\OrderProcStatus::all();
        }
        return self::$_OrderProcStats;

    }//EOF

    public static function reOrganizeJSONResponse(&$aResponseData, $ctx)
    {

        switch ($ctx) {
            case pg_ctx_stall_orders:
                return self::reOrganizeJSONResponse_StallOrders($aResponseData);
                break;
            case pg_ctx_stall_orders_history:
                return self::reOrganizeJSONResponse_StallOrdersHistory($aResponseData);
                break;
        }

        return array();
    }//EOF

    private static function reOrganizeJSONResponse_StallOrders(&$aStallOrders)
    {
        $CompOrderIds = array();
        foreach ($aStallOrders as $k => $OrderItem) {
            $CompOrderIds[] = $OrderItem->comp_order_id;
        }
        $id_list = array_unique($CompOrderIds);


        $aStallOrders_Reorganised = array();

        foreach ($id_list as $id) {

            foreach ($aStallOrders as $k => $OrderItem) {
                if ($OrderItem->comp_order_id != $id) continue;

                if (!isset($aStallOrders_Reorganised[$id])) {

                    $Order = array(
                        "user_id" => $OrderItem->comp_user_id,
                        "comp_order_id" => $OrderItem->comp_order_id,
                        "order_code" => $OrderItem->order_code,
                        "stall_order_code" => $OrderItem->stall_order_code,
                        "stall_order_amt" => $OrderItem->stall_order_amt,
                        "stall_id" => $OrderItem->stall_id,
                        "order_date" => $OrderItem->order_date,
                        "order_status" => $OrderItem->order_status,
                        "stall_order_proc_status" => $OrderItem->stall_order_proc_status
                    );
                    $aStallOrders_Reorganised[$id] = $Order;
                    $aStallOrders_Reorganised[$id]['order_items'] = [];
                }

                $OrderItem = array(
                    "item_id" => $OrderItem->item_id,
                    "stall_food_item_id" => $OrderItem->stall_food_item_id,
                    "food_item_name" => $OrderItem->food_item_name,
                    "quantity" => $OrderItem->quantity,
                    "unit_price" => $OrderItem->unit_price,
                    "item_total_amt" => $OrderItem->item_total_amt
                );

                $aStallOrders_Reorganised[$id]['order_items'][] = $OrderItem;
            }

        }


        return $aStallOrders_Reorganised;

    }//EOF

    private static function reOrganizeJSONResponse_StallOrdersHistory_bak(&$aStallOrders)
    {
        $CompOrderIds = array();
        foreach ($aStallOrders as $k => $OrderItem) {
            $CompOrderIds[] = $OrderItem->comp_order_id;
        }
        $id_list = array_unique($CompOrderIds);

        $aStallOrders_Reorganised = array();

        foreach ($id_list as $id) {

            foreach ($aStallOrders as $k => $OrderItem) {
                if ($OrderItem->comp_order_id != $id) continue;

                if (!isset($aStallOrders_Reorganised[$id])) {

                    $Order = array(
                        "comp_order_id" => $OrderItem->comp_order_id,
                        "stall_order_code" => $OrderItem->stall_order_code,
                        "stall_order_amt" => $OrderItem->stall_order_amt,
                        "stall_id" => $OrderItem->stall_id,
                        "stall_order_id" => $OrderItem->stall_order_id,
                        "order_date" => $OrderItem->order_date,
                        "order_status" => $OrderItem->order_status,
                        "stall_order_proc_status" => $OrderItem->stall_order_proc_status,
                        "delivery_date" => $OrderItem->delivery_date,
                        "delivery_time" => $OrderItem->delivery_time,
                    );
                    $aStallOrders_Reorganised[$id] = $Order;
                    $aStallOrders_Reorganised[$id]['order_items'] = [];
                }

                $OrderItem = array(
                    "stall_food_item_id" => $OrderItem->stall_food_item_id,
                    "food_item_name" => $OrderItem->food_item_name,
                    "quantity" => $OrderItem->quantity,
                    "unit_price" => $OrderItem->unit_price,
                    "item_total_amt" => $OrderItem->item_total_amt
                );

                $aStallOrders_Reorganised[$id]['order_items'][] = $OrderItem;
            }

        }

        return $aStallOrders_Reorganised;

    }//EOF

    private static function reOrganizeJSONResponse_StallOrdersHistory(&$aStallOrders)
    {
        $CompOrderIds = array();
        foreach ($aStallOrders as $k => $OrderItem) {
            $CompOrderIds[] = $OrderItem->comp_order_id;
        }
        $id_list = array_unique($CompOrderIds);

        $aStallOrders_Reorganised = array();

        foreach ($id_list as $id) {

            foreach ($aStallOrders as $k => $OrderItem) {
                if ($OrderItem->comp_order_id != $id) continue;

                if (!isset($aStallOrders_Reorganised[$id])) {

                    $Order = array(
                        "comp_order_id" => $OrderItem->comp_order_id,
                        "stall_order_code" => $OrderItem->stall_order_code,
                        "stall_order_amt" => $OrderItem->stall_order_amt,
                        "stall_id" => $OrderItem->stall_id,
                        "stall_order_id" => $OrderItem->stall_order_id,
                        "order_date" => $OrderItem->order_date,
                        "order_status" => $OrderItem->order_status,
                        "stall_order_proc_status" => $OrderItem->stall_order_proc_status,
                        "delivery_date" => $OrderItem->delivery_date,
                        "delivery_time" => $OrderItem->delivery_time,
                    );
                    $aStallOrders_Reorganised[$id] = $Order;
                    $aStallOrders_Reorganised[$id]['order_items'] = [];
                }

                $OrderItem = array(
                    "stall_food_item_id" => $OrderItem->stall_food_item_id,
                    "food_item_name" => $OrderItem->food_item_name,
                    "quantity" => $OrderItem->quantity,
                    "unit_price" => $OrderItem->unit_price,
                    "item_total_amt" => $OrderItem->item_total_amt
                );

                $aStallOrders_Reorganised[$id]['order_items'][] = $OrderItem;
            }

        }

        return $aStallOrders_Reorganised;

    }//EOF
}
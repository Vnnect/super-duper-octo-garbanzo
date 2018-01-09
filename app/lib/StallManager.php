<?php

namespace App\lib;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Illuminate\Database\QueryException;
use \App\models\Stall;
use \Exception;
use \Validator;
use \App\lib;

class StallManager
{
    public function listAll(Request $request, $id)
    {

        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::ListJsonParseError(pg_tbl_stall);
            }

            $vend = new Stall();
            if ($id) {
                $resp = $vend->findOrFail($id);
            } else {
                $resp = $vend->all();
            }

            return PgResponse::ListSuccess(["status" => 1, "results" => $resp]);

        } catch (Exception $e) {
            return PgResponse::ListError(pg_tbl_stall, $e);
        }

    }//EOF

    public function insert(Request $request)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::InsertJsonParseError(pg_tbl_stall);
            }

            $this->preProcessData($aJsonContent);

            $validation = $this->validateForInsert($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            $vend = new Stall();
            $vend->fill($aJsonContent);

            $resp = null;

            if ($vend->save()) {
                $resp = PgResponse::InsertSuccess($vend->id);
            } else {
                $resp = PgResponse::InsertFailed($vend->getTable());
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::InsertError(pg_tbl_stall, $e);
        }

    }//EOF

    public function update(Request $request, $id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::UpdateJsonParseError(pg_tbl_stall);
            }

            $this->preProcessData($aJsonContent);

            $validation = $this->validateForUpdate($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            $vend = Stall::findOrFail($id);
            $vend->fill($aJsonContent);
            $resp = null;

            if ($vend->save()) {
                $resp = PgResponse::UpdateSuccess($vend);
            } else {
                $resp = PgResponse::UpdateFailed($vend->getTable());
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::UpdateError(pg_tbl_stall, $e);
        }

    }//EOF

    public function delete(Request $request, $id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::DeleteJsonParseError(pg_tbl_stall);
            }

            $deleted_rows = Stall::where('id', $id)->delete();

            $resp = null;

            if ($deleted_rows) {
                $resp = PgResponse::DeleteSuccess($id);
            } else {
                $resp = PgResponse::DeleteFailed(pg_tbl_stall, $id);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::DeleteError(pg_tbl_stall, $e);
        }

    }//EOF

    public function validateForInsert($JsonInput)
    {

        $validator = Validator::make($JsonInput, self::getRulesForInsert());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed(pg_tbl_stall, $validator);
        }

        return TRUE;

    }//EOF

    public function validateForUpdate($JsonInput)
    {

        $validator = Validator::make($JsonInput, self::getRulesForUpdate());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed(pg_tbl_stall, $validator);
        }

        return TRUE;

    }//EOF

    public function getRulesForInsert()
    {

        $rules = [
            'stall_no' => 'required|required|max:30',
            'court_id' => 'required|numeric|digits_between:1,10',
            'vendor_id' => 'required|numeric|digits_between:1,10',
            'open_today' => 'boolean',
            'working_days' => 'required|max:40',
            'working_hours' => 'required|max:100',
            'todays_special' => 'max:100'
        ];

        return $rules;

    }//EOF

    public function getRulesForUpdate()
    {
        $rules = [
            'stall_no' => 'max:30',
            'court_id' => 'numeric|digits_between:1,10',
            'vendor_id' => 'numeric|digits_between:1,10',
            'open_today' => 'boolean',
            'working_days' => 'max:40',
            'working_hours' => 'max:100',
            'todays_special' => 'max:100',
        ];

        return $rules;

    }//EOF

    public function preProcessData(&$aJsonData)
    {
        if (!is_array($aJsonData)) {
            return;
        }

        $aJsonData['open_today'] = (int)$aJsonData['open_today'];

    }//EOF

    public function getMenu($stall_id, $menuitem_id = null)
    {

        try {
            if (isset($menuitem_id)) {
                $result = DB::table(pg_tbl_stall . ' AS stl')
                    ->join(pg_tbl_stall_food_item . ' AS sfi', 'stl.id', '=', 'sfi.stall_id')
                    ->where('stl.id', $stall_id)
                    ->where('sfi.id', $menuitem_id)
                    ->orderby('sfi.name')
                    ->get();
            } else {
                $result = DB::table(pg_tbl_stall . ' AS stl')
                    ->join(pg_tbl_stall_food_item . ' AS sfi', 'stl.id', '=', 'sfi.stall_id')
                    ->where('stl.id', $stall_id)
                    ->select(
                        'sfi.id as food_item_id', 'name as food_item_name', 'unit_price', 'desc', 'available_days', 'active as available','img',
                        'stall_no', 'working_days', 'working_hours', 'foodcat_id', 'open_today', 'stall_id', 'court_id', 'vendor_id'
                    )
                    ->orderby('sfi.name')
                    ->get();
            }

            return PgResponse::ListSuccess(["status" => 1, "results" => $result]);

        } catch (QueryException $e) {
            return PgResponse::ListError('stall menu', $e);
        }

    }//EOF


    public function addStallMenuItem(Request $request, $stall_id)
    {

        try {

            $StallfoodItemMgr = new StallFoodItemManager();
            return $StallfoodItemMgr->insert($request, $stall_id);

        } catch (QueryException $e) {
            return PgResponse::InsertError(pg_tbl_stall_food_item, $e);
        }

    }//EOF

    public function updateStallMenuItem(Request $request, $stall_id, $stall_food_item_id)
    {

        try {

            $StallfoodItemMgr = new StallFoodItemManager();
            return $StallfoodItemMgr->update($request, $stall_id, $stall_food_item_id);

        } catch (QueryException $e) {
            return PgResponse::InsertError(pg_tbl_stall_food_item, $e);
        }

    }//EOF

    public function deleteStallMenuItem(Request $request, $stall_id, $stall_food_item_id)
    {
        try {

            $StallfoodItemMgr = new StallFoodItemManager();
            return $StallfoodItemMgr->delete($request, $stall_id, $stall_food_item_id);

        } catch (QueryException $e) {
            return PgResponse::InsertError(pg_tbl_stall_food_item, $e);
        }

    }//EOF

    public function getCourtStalls($court_id)
    {
        try {

            if ($court_id) {
                $resp = Stall::where('court_id', $court_id)->get();
            } else {
                $resp = array();
            }

            return PgResponse::ListSuccess($resp);

        } catch (Exception $e) {
            return PgResponse::ListError(pg_tbl_stall, $e);
        }

    }//EOF

    public function getOrderHistory($stall_id)
    {
        $order = new lib\OrderManager();
        return $order->getStallOrderHistory($stall_id);
    }

}
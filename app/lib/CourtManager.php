<?php

namespace App\lib;

use \Illuminate\Support\Facades\DB;
use \App\models\Court;
use \Exception;
use \App\lib;
use \Validator;

class CourtManager
{
    public function listAll($request, $id)
    {

        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::ListJsonParseError(pg_tbl_court);
            }

            $foodcourt = new Court();
            if ($id) {
                $resp = $foodcourt->findOrFail($id);
            } else {
                $resp = $foodcourt->all();
            }

            return PgResponse::ListSuccess(["status" => 1, "results" => $resp]);

        } catch (Exception $e) {
            return PgResponse::ListError(pg_tbl_court, $e);
        }

    }//EOF

    public function insert($request)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::InsertJsonParseError(pg_tbl_court);
            }

            $validation = $this->validateForInsert($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            $foodcourt = new Court();
            $foodcourt->fill($aJsonContent);

            $resp = null;

            if ($foodcourt->save()) {
                $resp = PgResponse::InsertSuccess($foodcourt->id);
            } else {
                $resp = PgResponse::InsertFailed($foodcourt->getTable());
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::InsertError(pg_tbl_court, $e);
        }

    }//EOF

    public function update($request, $id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::UpdateJsonParseError(pg_tbl_court);
            }

            $validation = $this->validateForUpdate($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            $foodcourt = Court::findOrFail($id);
            $foodcourt->fill($aJsonContent);
            $resp = null;

            if ($foodcourt->save()) {
                $resp = PgResponse::UpdateSuccess($foodcourt);
            } else {
                $resp = PgResponse::UpdateFailed($foodcourt->getTable());
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::UpdateError(pg_tbl_court, $e);
        }

    }//EOF

    public function delete($request, $id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::DeleteJsonParseError(pg_tbl_court);
            }

            $deleted_rows = Court::where('id', $id)->delete();

            $resp = null;

            if ($deleted_rows) {
                $resp = PgResponse::DeleteSuccess($id);
            } else {
                $resp = PgResponse::DeleteFailed(pg_tbl_court, $id);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::DeleteError(pg_tbl_court, $e);
        }

    }//EOF

    public function validateForInsert($JsonInput)
    {

        $validator = Validator::make($JsonInput, self::getRulesForInsert());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed(pg_tbl_court, $validator);
        }

        return TRUE;

    }//EOF

    public function validateForUpdate($JsonInput)
    {

        $validator = Validator::make($JsonInput, self::getRulesForUpdate());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed(pg_tbl_court, $validator);
        }

        return TRUE;

    }//EOF

    public function getRulesForInsert()
    {
        $rules = [
            'name' => 'required|max:50',
            'venue_id' => 'required|numeric|digits_between:1, 10' . '|exists:' . pg_tbl_venue . ',id',
            'location_code' => 'max:10',
            'land_mark' => 'max:30',
            'location_map' => 'max:60'
        ];

        return $rules;

    }//EOF

    public function getRulesForUpdate()
    {
        $rules = [
            'name' => 'max:50',
            'location_code' => 'max:10',
            'venue_id' => 'numeric|digits_between:1,10',
            'land_mark' => 'max:30',
            'location_map' => 'max:60'
        ];

        return $rules;
    }//EOF

    public function getMenu($court_id)
    {

        try {
            $result = DB::table(pg_tbl_court . ' AS crt')
                ->join(pg_tbl_stall . ' AS stl', 'crt.id', '=', 'stl.court_id')
                ->join(pg_tbl_stall_food_item . ' AS sfi', 'stl.id', '=', 'sfi.stall_id')
                ->where('crt.id', $court_id)
                ->select(
                    'sfi.name as food_item_name',
                    'unit_price', 'desc', 'available_days', 'active as available',
                    'stl.stall_no as stall_no', 'open_today', 'working_days', 'working_hours', 'todays_special',
                    'land_mark', 'stall_id', 'sfi.id as food_item_id', 'foodcat_id', 'vendor_id', 'court_id', 'venue_id'
                )
                ->get();

            return PgResponse::ListSuccess($result);

        } catch (QueryException $e) {
            return PgResponse::ListError('court menu', $e);
        }

    }//EOF


    public function getVenueCourts($venue_id)
    {
        try {

            if ($venue_id) {
                $resp = Court::where('venue_id', $venue_id)->get();
            } else {
                $resp = array();
            }

            return PgResponse::ListSuccess($resp);

        } catch (Exception $e) {
            return PgResponse::ListError(pg_tbl_court, $e);
        }

    }//EOF


}
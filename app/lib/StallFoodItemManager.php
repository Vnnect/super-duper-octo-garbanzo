<?php

namespace App\lib;

use \App\lib;
use App\models\StallFoodItem;
use \Illuminate\Http\Request;
use \Validator;

class StallFoodItemManager
{

    public function insert(Request $request, $stall_id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::InsertJsonParseError(pg_tbl_stall_food_item);
            }

            $aJsonContent['food_item']['stall_id'] = $stall_id;

            $this->preProcessData($aJsonContent);

            $validation = $this->validateForInsert($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            $StallFoodItem = new StallFoodItem();
            $StallFoodItem->stall_id = $stall_id;
            $StallFoodItem->fill($aJsonContent['food_item']);

            $resp = null;

            if ($StallFoodItem->save()) {
                $resp = PgResponse::InsertSuccess($StallFoodItem->id);
            } else {
                $resp = PgResponse::InsertFailed(pg_tbl_stall_food_item);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::InsertError(pg_tbl_stall_food_item, $e);
        }

    }//EOF

    public function update($request, $stall_id, $stall_food_item_id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::UpdateJsonParseError(pg_tbl_stall_food_item);
            }

            $this->preprocessData($aJsonContent);

            $validation = $this->validateForUpdate($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            unset($aJsonContent['food_item']['stall_id']);      //never change the stall_id while updating
            $StallFoodItem = StallFoodItem::findOrFail($stall_food_item_id);
            $StallFoodItem->fill($aJsonContent['food_item']);

            $resp = null;

            if ($StallFoodItem->save()) {
                $resp = PgResponse::UpdateSuccess($StallFoodItem);
            } else {
                $resp = PgResponse::UpdateFailed(pg_tbl_stall_food_item);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::UpdateError(pg_tbl_stall_food_item, $e);
        }

    }//EOF

    public function delete($request, $stall_id, $stall_food_item_id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::InsertJsonParseError(pg_tbl_stall_food_item);
            }

            $deleted_rows = StallFoodItem::where('id', $stall_food_item_id)->delete();

            $resp = null;

            if ($deleted_rows) {
                $resp = PgResponse::DeleteSuccess($stall_food_item_id);
            } else {
                $resp = PgResponse::DeleteFailed(pg_tbl_stall_food_item, $stall_food_item_id);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::DeleteError(pg_tbl_stall_food_item, $e);
        }

    }//EOF

    public function validateForInsert($JsonInput)
    {

        $validator = Validator::make($JsonInput['food_item'], self::getRulesForInsert());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed(pg_tbl_stall_food_item, $validator);
        }

        return TRUE;

    }//EOF

    public function validateForUpdate($JsonInput)
    {

        $validator = Validator::make($JsonInput['food_item'], self::getRulesForUpdate());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed(pg_tbl_stall_food_item, $validator);
        }

        return TRUE;

    }//EOF

    public function getRulesForInsert()
    {
        $rules = Array(
            'name' => 'required|min:3|max:60',
            'foodcat_id' => 'required|numeric|digits_between:1,10',
            'stall_id' => 'required|numeric|digits_between:1,10',
            'unit_price' => "required|regex:/^\d*(\.\d{1,2})?$/",
            'active' => 'required|boolean',
            'available_days' => 'required|max:60',
            'desc' => 'max:200',
            'img' => 'max:60'
        );

        return $rules;
    }

    public function getRulesForUpdate()
    {
        $rules = Array(
            'name' => 'min:3|max:60',
            'foodcat_id' => 'numeric|digits_between:1,11',
            'unit_price' => "regex:/^\d*(\.\d{1,2})?$/",
            'active' => 'boolean',
            'available_days' => 'max:60',
            'desc' => 'max:200',
            'img' => 'max:60'
        );

        return $rules;
    }

    public function preProcessData(&$aJsonData)
    {

        if (!is_array($aJsonData)) {
            return;
        }

        if (isset($aJsonData['food_item']['active'])) {
            $aJsonData['food_item']['active'] = (int)$aJsonData['food_item']['active'];
        }

    }//EOF
}
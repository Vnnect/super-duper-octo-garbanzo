<?php

namespace App\lib;

use Illuminate\Http\Request;
use App\models\FoodItem;
use \Validator;
use App\lib;

class FoodItemManager
{
    public function listAll($request, $id)
    {

        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::ListJsonParseError(pg_tbl_fooditem);
            }

            $fooditem = new FoodItem();

            if ($id) {
                $resp = $fooditem->findOrFail($id);
            } else {
                $resp = $fooditem->all();
            }

            return PgResponse::ListSuccess($resp);

        } catch (Exception $e) {
            return PgResponse::ListError(pg_tbl_fooditem, $e);
        }

    }//EOF

    public function insert(Request $request)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::InsertJsonParseError(pg_tbl_fooditem);
            }

            $this->preProcessData($aJsonContent);

            $validation = $this->validateForInsert($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            $fooditem = new FoodItem();
            $fooditem->fill($aJsonContent);

            $resp = null;

            if ($fooditem->save()) {
                $resp = PgResponse::InsertSuccess($fooditem->id);
            } else {
                $resp = PgResponse::InsertFailed(pg_tbl_fooditem);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::InsertError(pg_tbl_fooditem, $e);
        }

    }//EOF

    public function insert_json(&$aJsonContent)
    {
        try {

            $this->preProcessData($aJsonContent);

            $validation = $this->validateForInsert($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            $fooditem = new FoodItem();
            $fooditem->fill($aJsonContent);

            $resp = null;

            if ($fooditem->save()) {
                $resp = PgResponse::InsertSuccess($fooditem->id);
            } else {
                $resp = PgResponse::InsertFailed(pg_tbl_fooditem);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::InsertError(pg_tbl_fooditem, $e);
        }

    }//EOF

    public function update($request, $id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::UpdateJsonParseError(pg_tbl_fooditem);
            }

            $this->preprocessData($aJsonContent);

            $validation = $this->validateForUpdate($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            $fooditem = FoodItem::findOrFail($id);
            $fooditem->fill($aJsonContent);
            $resp = null;

            if ($fooditem->save()) {
                $resp = PgResponse::UpdateSuccess($fooditem);
            } else {
                $resp = PgResponse::UpdateFailed(pg_tbl_fooditem);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::UpdateError(pg_tbl_fooditem, $e);
        }

    }//EOF

    public function delete($request, $id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::InsertJsonParseError(pg_tbl_fooditem);
            }

            $deleted_rows = FoodItem::where('id', $id)->delete();

            $resp = null;

            if ($deleted_rows) {
                $resp = PgResponse::DeleteSuccess($id);
            } else {
                $resp = PgResponse::DeleteFailed(pg_tbl_fooditem, $id);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::DeleteError(pg_tbl_fooditem, $e);
        }

    }//EOF

    public function preProcessData(&$aJsonData)
    {

        if (!is_array($aJsonData)) {
            return;
        }

        $aJsonData['active'] = (int)$aJsonData['active'];
        $aJsonData['package'] = (int)$aJsonData['package'];

    }//EOF

    public function validateForInsert($JsonInput)
    {

        $validator = Validator::make($JsonInput, self::getRulesForInsert());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed(pg_tbl_fooditem, $validator);
        }

        return TRUE;

    }//EOF

    public function validateForUpdate($JsonInput)
    {

        $validator = Validator::make($JsonInput, self::getRulesForUpdate());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed(pg_tbl_fooditem, $validator);
        }

        return TRUE;

    }//EOF

    public function getRulesForInsert()
    {
        $rules = [
            'name' => 'required|min:3|max:60',
            'code' => 'required|min:3|max:10|unique:' . pg_tbl_fooditem . ',code',
            'foodcat_id' => 'required|numeric|digits_between:1,11',
            'desc' => 'max:200',
            'img_rep' => 'max:60'
        ];

        return $rules;

    }//EOF

    public function getRulesForUpdate()
    {
        $rules = [
            'name' => 'required|min:3|max:60',
            'code' => 'required|min:3|max:10|unique:' . pg_tbl_fooditem . ',code',
            'foodcat_id' => 'required|numeric|digits_between:1,11',
            'desc' => 'max:200',
            'img_rep' => 'max:60'
        ];

        return $rules;

    }//EOF

}
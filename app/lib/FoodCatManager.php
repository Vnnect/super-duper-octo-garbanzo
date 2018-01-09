<?php


namespace App\lib;

use Illuminate\Http\Request;
use \App\models\FoodCat;
use \Exception;
use \App\lib;
use \Validator;

class FoodCatManager
{
    public function listAll(Request $request, $id)
    {

        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::ListJsonParseError(pg_tbl_foodcat);
            }

            $foodcat = new FoodCat();

            if ($id) {
                $resp = $foodcat->findOrFail($id);
            } else {
                $resp = $foodcat->all();
            }

            return PgResponse::ListSuccess($resp);

        } catch (Exception $e) {
            return PgResponse::ListError(pg_tbl_foodcat, $e);
        }

    }//EOF

    public function insert($request)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::InsertJsonParseError(pg_tbl_foodcat);
            }

            $validation = $this->validateForInsert($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            $foodcat = new FoodCat();
            $foodcat->fill($aJsonContent);


            $resp = null;

            if ($foodcat->save()) {
                $resp = PgResponse::InsertSuccess($foodcat->id);
            } else {
                $resp = PgResponse::InsertFailed(pg_tbl_foodcat);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::InsertError(pg_tbl_foodcat, $e);
        }

    }//EOF

    public function update(Request $request, $id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::UpdateJsonParseError(pg_tbl_foodcat);
            }

            $validation = $this->validateForUpdate($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            $foodcat = FoodCat::findOrFail($id);
            $foodcat->fill($aJsonContent);
            $resp = null;

            if ($foodcat->save()) {
                $resp = PgResponse::UpdateSuccess($foodcat);
            } else {
                $resp = PgResponse::UpdateFailed(pg_tbl_foodcat);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::UpdateError(pg_tbl_foodcat, $e);
        }

    }//EOF

    public function delete(Request $request, $id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::InsertJsonParseError(pg_tbl_foodcat);
            }

            $deleted_rows = FoodCat::where('id', $id)->delete();

            $resp = null;

            if ($deleted_rows) {
                $resp = PgResponse::DeleteSuccess($id);
            } else {
                $resp = PgResponse::DeleteFailed(pg_tbl_foodcat, $id);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::DeleteError(pg_tbl_foodcat, $e);
        }

    }//EOF

    public function validateForInsert($JsonInput)
    {

        $validator = Validator::make($JsonInput, self::getRulesForInsert());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed(pg_tbl_foodcat, $validator);
        }

        return TRUE;

    }//EOF

    public function validateForUpdate($JsonInput)
    {

        $validator = Validator::make($JsonInput, self::getRulesForUpdate());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed(pg_tbl_foodcat, $validator);
        }

        return TRUE;

    }//EOF

    public function getRulesForInsert()
    {
        $rules = [
            'name' => 'required|max:50',
            'active' => 'required|boolean',
        ];

        return $rules;

    }//EOF

    public function getRulesForUpdate()
    {
        $rules = [
            'name' => 'max:50',
            'active' => 'boolean',
        ];
        return $rules;
    }//EOF

}
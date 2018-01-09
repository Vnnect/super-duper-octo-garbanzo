<?php

namespace App\lib;

use Illuminate\Http\Request;
use \App\models\Venue;
use \Exception;
use \Validator;
use \App\lib;

class VenueManager
{
    public function listAll($request, $id = null)
    {

        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::ListJsonParseError(pg_tbl_venue);
            }

            $ven = new Venue();

            if ($id) {
                $resp = $ven->findOrFail($id);
            } else {
                $resp = $ven->all();
            }


            return PgResponse::ListSuccess(["status" => 1, "results" => $resp]);

        } catch (Exception $e) {
            return PgResponse::ListError(pg_tbl_venue, $e);
        }

    }//EOF

    public function insert($request)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::InsertJsonParseError(pg_tbl_venue);
            }

            $validation = $this->validateForInsert($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            $ven = new Venue();
            $ven->fill($aJsonContent);

            $resp = array();

            if ($ven->save()) {
                $resp = PgResponse::InsertSuccess($ven->id);
            } else {
                $resp = PgResponse::InsertFailed(pg_tbl_venue);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::InsertError(pg_tbl_venue, $e);
        }

    }//EOF

    public function update($request, $id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::UpdateJsonParseError(pg_tbl_venue);
            }

            $validation = $this->validateForUpdate($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            $ven = Venue::findOrFail($id);
            $ven->fill($aJsonContent);
            $resp = array();

            if ($ven->save()) {
                $resp = PgResponse::UpdateSuccess($ven);
            } else {
                $resp = PgResponse::UpdateFailed(pg_tbl_venue);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::UpdateError(pg_tbl_venue, $e);
        }

    }//EOF

    public function delete($request, $id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::InsertJsonParseError(pg_tbl_venue);
            }

            $deleted_rows = Venue::where('id', $id)->delete();

            $resp = array();

            if ($deleted_rows) {
                $resp = PgResponse::DeleteSuccess($id);
            } else {
                $resp = PgResponse::DeleteFailed(pg_tbl_venue, $id);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::DeleteError(pg_tbl_venue, $e);
        }

    }//EOF

    public function validateForInsert($JsonInput)
    {

        $validator = Validator::make($JsonInput, self::getRulesForInsert());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed(pg_tbl_venue, $validator);
        }

        return TRUE;

    }//EOF

    public function validateForUpdate($JsonInput)
    {

        $validator = Validator::make($JsonInput, self::getRulesForUpdate());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed(pg_tbl_venue, $validator);
        }

        return TRUE;

    }//EOF

    public function getRulesForInsert()
    {
        $rules = [
            'name' => 'required|max:100',
            'code' => 'required|min:3|max:7',
            'address_id' => 'required|numeric|digits_between:1,10' . '|exists:' . pg_tbl_address . ',id'
        ];

        return $rules;

    }//EOF

    public function getRulesForUpdate()
    {
        $rules = [
            'name' => 'max:100',
            'code' => 'min:3|max:7'
        ];
        return $rules;
    }//EOF

}
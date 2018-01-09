<?php

namespace App\lib;

use \App\models\Address;
use \Exception;
use \App\lib;
use \Validator;

class AddressManager
{
    public function listAll($request, $id)
    {

        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::ListJsonParseError(pg_tbl_address);
            }

            $vend = new Address();
            if ($id) {
                $resp = $vend->findOrFail($id);
            } else {
                $resp = $vend->all();
            }

            return PgResponse::ListSuccess($resp);

        } catch (Exception $e) {
            return PgResponse::ListError(pg_tbl_address, $e);
        }

    }//EOF

    public function insert($request)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::InsertJsonParseError(pg_tbl_address);
            }

            $validation = $this->validateForInsert($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            $vend = new Address();
            $vend->fill($aJsonContent);

            $resp = null;

            if ($vend->save()) {
                $resp = PgResponse::InsertSuccess($vend->id);
            } else {
                $resp = PgResponse::InsertFailed($vend->getTable());
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::InsertError(pg_tbl_address, $e);
        }

    }//EOF

    public function update($request, $id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::UpdateJsonParseError(pg_tbl_address);
            }

            $validation = $this->validateForUpdate($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            $vend = Address::findOrFail($id);
            $vend->fill($aJsonContent);
            $resp = null;

            if ($vend->save()) {
                $resp = PgResponse::UpdateSuccess($vend);
            } else {
                $resp = PgResponse::UpdateFailed($vend->getTable());
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::UpdateError(pg_tbl_address, $e);
        }

    }//EOF

    public function delete($request, $id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::DeleteJsonParseError(pg_tbl_address);
            }


            $deleted_rows = Address::where('id', $id)->delete();

            $resp = null;

            if ($deleted_rows) {
                $resp = PgResponse::DeleteSuccess($id);
            } else {
                $resp = PgResponse::DeleteFailed(pg_tbl_address, $id);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::DeleteError(pg_tbl_address, $e);
        }

    }//EOF

    public function validateForInsert($JsonInput)
    {

        $validator = Validator::make($JsonInput, self::getRulesForInsert());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed(pg_tbl_address, $validator);
        }

        return TRUE;

    }//EOF

    public function validateForUpdate($JsonInput)
    {

        $validator = Validator::make($JsonInput, self::getRulesForUpdate());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed(pg_tbl_address, $validator);
        }

        return TRUE;

    }//EOF

    public function getRulesForInsert()
    {
        $rules = [
            'street' => 'required|max:150',
            'addressline1' => 'required|max:150',
            'addressline2' => 'required|max:150',
            'city' => 'required|max:50',
            'pincode' => 'required|max:7',
            'state' => 'required|max:50',
            'country' => 'required|max:50',
            'landmark' => 'max:50'
        ];

        return $rules;

    }//EOF

    public function getRulesForUpdate()
    {
        $rules = [
            'street' => 'required|max:150',
            'addressline1' => 'required|max:150',
            'addressline2' => 'required|max:150',
            'city' => 'required|max:50',
            'pincode' => 'required|max:7',
            'state' => 'required|max:50',
            'country' => 'required|max:50',
            'landmark' => 'max:50'
        ];
        return $rules;
    }//EOF
}
<?php

namespace App\lib;

use Illuminate\Http\Request;
use \App\models\Vendor;
use \Exception;
use \Validator;
use \App\lib;

class VendorManager
{
    public function listAll($request, $id = null)
    {

        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::ListJsonParseError(pg_tbl_vendor);
            }

            $vend = new Vendor();

            if ($id) {
                $resp = $vend->findOrFail($id);
            } else {
                $resp = $vend->all();
            }

            return PgResponse::ListSuccess($resp);

        } catch (Exception $e) {
            return PgResponse::ListError(pg_tbl_vendor, $e);
        }

    }//EOF

    public function insert($request)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::InsertJsonParseError(pg_tbl_vendor);
            }
            $this->preProcessData($aJsonContent);
            $validation = $this->validateForInsert($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            $vend = new Vendor();
            $vend->fill($aJsonContent);

            $resp = null;

            if ($vend->save()) {
                $resp = PgResponse::InsertSuccess($vend->id);
            } else {
                $resp = PgResponse::InsertFailed($vend->getTable());
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::InsertError(pg_tbl_vendor, $e);
        }

    }//EOF

    public function update($request, $id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::UpdateJsonParseError(pg_tbl_vendor);
            }
            $this->preProcessData($aJsonContent);
            $validation = $this->validateForUpdate($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            $vend = Vendor::findOrFail($id);
            $vend->fill($aJsonContent);
            $resp = null;

            if ($vend->save()) {
                $resp = PgResponse::UpdateSuccess($vend);
            } else {
                $resp = PgResponse::UpdateFailed($vend->getTable());
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::UpdateError(pg_tbl_vendor, $e);
        }

    }//EOF

    public function delete($request, $id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::DeleteJsonParseError(pg_tbl_vendor);
            }


            $deleted_rows = Vendor::where('id', $id)->delete();

            $resp = null;

            if ($deleted_rows) {
                $resp = PgResponse::DeleteSuccess($id);
            } else {
                $resp = PgResponse::DeleteFailed(pg_tbl_vendor, $id);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::DeleteError(pg_tbl_vendor, $e);
        }

    }//EOF

    public function preProcessData(&$aJsonData)
    {

        if (!is_array($aJsonData)) {
            return;
        }

        $aJsonData['active'] = (int)$aJsonData['active'];
        $aJsonData['verified'] = (int)$aJsonData['verified'];

    }//EOF

    public function validateForInsert($JsonInput)
    {

        $validator = Validator::make($JsonInput, self::getRulesForInsert());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed(pg_tbl_vendor, $validator);
        }

        return TRUE;

    }//EOF

    public function validateForUpdate($JsonInput)
    {

        $validator = Validator::make($JsonInput, self::getRulesForUpdate());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed(pg_tbl_vendor, $validator);
        }

        return TRUE;

    }//EOF

    public function getRulesForInsert()
    {

        $rules = [
            'bank_account_no' => "required|max:20|regex:/^[0-9]+$/",
            'bank_account_name' => 'required|max:100',
            'account_type' => 'required|max:3',
            'name' => 'required|max:20',
            'code' => 'required|min:3|max:6',
            'active' => 'required|boolean',
            'verified' => 'required|boolean',
            'verified_date' => 'nullable|date|date_format:Y-m-d|after:yesterday',
            'address_id' => 'required|numeric|digits_between:1,10' . '|exists:' . pg_tbl_address . ',id',
            'pancard_no' => 'required|alpha_num|size:10',
            'phone_no' => 'required|size:10',
            'contact_person' => 'required|min:2|max:50',
            'contact_email' => 'required|email|max:70'
        ];

        return $rules;

    }//EOF

    public function getRulesForUpdate()
    {
        $rules = [
            'bank_account_no' => "required|max:20|regex:/^[0-9]+$/",
            'bank_account_name' => 'max:100',
            'IFSC' => 'nullable|max:10',
            'account_type' => 'max:3',
            'name' => 'required|max:20',
            'active' => 'boolean',
            'verified' => 'boolean',
            'verified_date' => 'nullable|date|date_format:Y-m-d|after:yesterday',
            'address_id' => 'numeric|digits_between:1,10',
            'pancard_no' => 'alpha_num|size:10',
            'phone_no' => 'size:10',
            'contact_person' => 'min:2|max:50',
            'contact_email' => 'email|max:70'
        ];
        return $rules;
    }//EOF
}
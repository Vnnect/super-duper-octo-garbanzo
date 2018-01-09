<?php

namespace App\lib;

use Illuminate\Http\Request;
use \App\User;
use \Exception;
use \Validator;
use \App\lib;

class ProfileManager
{
    public function listAll($request, $id = null)
    {
    	try
    	{
    		$aJsonContent = array();

    		if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::ListJsonParseError(pg_tbl_venue);
            }

            $profile = new User;

             if ($id) {
                $resp = $profile->findOrFail($id);
            } else {
                $resp = "profile not found";
            }

             return PgResponse::ListSuccess(["status" => 1, "results" => $resp]);

        } 

        catch (Exception $e) 
        {
            return PgResponse::ListError(user, $e);
        }
    }//EOF

    public function insert($request)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::InsertJsonParseError('users');
            }

            $validation = $this->validateForInsert($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            $profile = new User();
            $profile->fill($aJsonContent);

            $resp = array();

            if ($profile->save()) {
                $resp = PgResponse::InsertSuccess($profile->id);
            } else {
                $resp = PgResponse::InsertFailed('users');
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::InsertError('users', $e);
        }

    }//EOF


  public function update($request, $id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::UpdateJsonParseError(users);
            }

            $validation = $this->validateForUpdate($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            $profile = User::findOrFail($id);
            $profile->fill($aJsonContent);
            $resp = array();

            if ($profile->save()) {
                $resp = PgResponse::UpdateSuccess($profile);
            } else {
                $resp = PgResponse::UpdateFailed(users);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::UpdateError('users', $e);
        }

    }//EOF

    public function validateForUpdate($JsonInput)
    {

        $validator = Validator::make($JsonInput, self::getRulesForUpdate());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed(users, $validator);
        }

        return TRUE;

    }//EOF


    public function getRulesForUpdate()
    {
        $rules = [
            'name' => 'required|max:100',
        ];
        return $rules;
    }//EOF
       
        public function validateForInsert($JsonInput)
    {

        $validator = Validator::make($JsonInput, self::getRulesForInsert());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed('users', $validator);
        }

        return TRUE;

    }//EOF
    public function getRulesForInsert()
    {
        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|email',
        ];

        return $rules;

    }//EOF
}

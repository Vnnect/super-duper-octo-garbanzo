<?php


namespace App\lib;

use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use App\models\Payments;
use \App\lib;
use \Validator;

class PaymentsManager
{

    public function insert(Request $request, $comp_order_id)
    {
        try {

            $aJsonContent = array();

            if (!pg_utils::IsValidJson($request, $aJsonContent)) {
                return PgResponse::InsertJsonParseError(pg_tbl_payments);
            }

            $aJsonContent['comp_order_id'] = $comp_order_id;
            $validation = $this->validateForInsert($aJsonContent);
            if ($validation !== TRUE) {
                return $validation;
            }

            DB::beginTransaction();

            $payment = new Payments();
            $payment->fill($aJsonContent);

            $resp = null;

            if ($payment->save()) {
                $resp = PgResponse::InsertSuccess($payment->id);
                $stat_resp = $this->ChangeCompOrderStatus($comp_order_id, $payment->comp_order_code, pg_utils::getOrderStatusId(pg_ord_stat_closed));
                DB::commit();   //we are committing even if the order status is not changed.

                if ($stat_resp['result'] !== pg_stat_success) {
                    $resp['msg'] = "Payment made but could not update composite order status";
                }

            } else {
                DB::rollback();
                $resp = PgResponse::InsertFailed($payment->getTable());
            }


            return $resp;

        } catch (Exception $e) {
            DB::rollback();
            return PgResponse::InsertError(pg_tbl_payments, $e);
        }

    }//EOF

    public function getRulesForInsert()
    {

        $rules = [
            'comp_order_id' => 'required|numeric|digits_between:1,10',
            'comp_order_code' => 'required|min:6|max:20',
            'trans_amt' => "required|max:16|regex:/^\d*(\.\d{1,2})?$/",
            'trans_id' => 'required|min:3|max:50',
            'trans_date' => 'required|date|date_format:Y-m-d H:i:s|after:yesterday',
            'trans_status' => 'max:20',
            'trans_tag' => 'max:20',
            'bank_message' => 'max:200',
        ];

        return $rules;
    }//EOF

    public function validateForInsert($JsonInput)
    {

        $validator = Validator::make($JsonInput, self::getRulesForInsert());

        if ($validator->fails()) {
            return lib\PgResponse::ValidationFailed(pg_tbl_payments, $validator);
        }

        return TRUE;

    }//EOF

    private function ChangeCompOrderStatus($comp_order_id, $comp_order_code, $iOrderStatus)
    {
        try {

            $rows_affected = DB::table(pg_tbl_composite_order)
                ->where('id', $comp_order_id)
                ->where('code', $comp_order_code)
                ->update(['status' => $iOrderStatus]);

            if ($rows_affected > 0) {
                $resp = PgResponse::UpdateSuccess(null, $rows_affected);
            } else if ($rows_affected == 0) {
                $resp = PgResponse::UpdatedNone();
            } else {
                $resp = PgResponse::UpdateFailed(pg_tbl_composite_order);
            }

            return $resp;

        } catch (Exception $e) {
            return PgResponse::UpdateError(pg_tbl_composite_order, $e);
        }

    }//EOF

}
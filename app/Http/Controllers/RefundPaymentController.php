<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\lib;
use Illuminate\Support\Facades\DB;
use \Illuminate\Database\QueryException;
use \App\models;
use League\Flysystem\Exception;
use \Validator;
use \App\User;

class RefundPaymentController extends Controller
{

    //getting the ordercode and the user for that order.
    public function get($ordercode)
    {
         $total_amount=0;

         $order = new lib\OrderManager();

         $orders =  $order->getOrder($ordercode);
         foreach ($orders as $order) {
               $amount =  $order->order_amt;
         //add otal amount array of compoiste order 
                $total_amount += $amount;
         }
        // $user_info;
      $user_info  = $this->getProfile($order->user_id);
        //composite order_id for getting payment details
      $payment_comp_order  = $this->getPaymentDetails($order->comp_order_id);

      // dd($payment_comp_order);

      // return $details[] = [$total_amount, $user_info, $orders, $payment_comp_order];
        // return  $orders;

      return response()
            ->json(['total_amount' => $total_amount, 'user_info' => $user_info, 'payment_comp_order' => $payment_comp_order, 'orders' => $orders ]);
    }

     public function getProfile($id=null)
    {
           $profile = new User;

             if ($id) {
                $resp = $profile->findOrFail($id);
            } else {
                $resp = "profile not found";
            }
            return $resp;
         
    }
    public function getPaymentDetails($comp_order_id)
    {
        //get the payment deatils for the comp_order realted to the user.
     return  $payment_details = DB::table('pg_payments')->select('*')->where('comp_order_id', $comp_order_id)->get();
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;
use \App\models\StallFoodItem;
use \App\models\FoodCat;
use View;
use Session;
use Redirect;

class FoodIndex extends Controller
{
     public function index(Request $request)
    {
       $food = StallFoodItem::all();
        $food_cat = FoodCat::all();
         
        $main_stall_id = $request->vendor_stall_id;
   
         //sending only the stall id menues
        $cruds = StallFoodItem::select('*')->where('stall_id', $main_stall_id)->paginate(100);

        // ****************start from here********************

           // $cruds = StallFoodItem::orderBy('id','DESC');
        return view('foods.food_items_index',compact('cruds','main_stall_id'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
}

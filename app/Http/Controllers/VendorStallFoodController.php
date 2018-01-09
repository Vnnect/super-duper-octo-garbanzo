<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;
use \App\models\StallFoodItem;
use \App\models\FoodCat;
use View;

class VendorStallFoodController extends Controller
{

    protected $rules =
    [
        'name' => 'required',
        'foodcat_id' => 'required',
        'stall_id' => 'required',
        'unit_price' => 'required',
        'available_days' => 'required',
        'desc'=> 'required',

    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $food = StallFoodItem::all();
        $food_cat = FoodCat::all();
         
         $main_stall_id = $request->vendor_stall_id;

         //sending only the stall id menues
        $stall_id = StallFoodItem::select('*')->where('stall_id', 6)->get();

        return view('foods.index', ['stall_food'=> $stall_id, 'food_cat'=> $food_cat, 'main_stall_id'=>$main_stall_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $stall_food = new StallFoodItem();
            $stall_food->name = $request->name;
            $stall_food->foodcat_id = $request->foodcat_id;
            $stall_food->stall_id = $request->stall_id;
            $stall_food->unit_price = $request->unit_price;
            $stall_food->available_days = $request->available_days;
            $stall_food->desc = $request->desc;
             $stall_food->img = $request->img;

            // $path = $request->img->store('../../public/images');
            // $request->img = $path;

            $stall_food->save();
            return response()->json($stall_food);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stall_food = StallFoodItem::findOrFail($id);

        return view('foods.show', ['stall_food' => $stall_food]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $stall_food = StallFoodItem::findOrFail($id);
            $stall_food->name = $request->name;
            $stall_food->foodcat_id = $request->foodcat_id;
            $stall_food->stall_id = $request->stall_id;
            $stall_food->unit_price = $request->unit_price;
            $stall_food->available_days = $request->available_days;
            $stall_food->desc = $request->desc;
            $stall_food->img = $request->img;

            Storage::disk('uploads')->put($stall_food->img , $file_content);
            $stall_food->save();
            return ressnse()->json($stall_food);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stall_food = StallFoodItem::findOrFail($id);
        $stall_food->delete();

        return response()->json($stall_food);
    }

     public function changeStatus() 
    {
        $id = Input::get('id');
        dd($id);

        $stall_food = StallFoodItem::findOrFail($id);
        
        $stall_food->is_published = !$stall_food->is_published;
        $stall_food->save();

        return response()->json($stall_food);
    }
}

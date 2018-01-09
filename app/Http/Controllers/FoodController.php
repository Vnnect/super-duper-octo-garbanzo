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

class FoodController extends Controller
{
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
        $cruds = StallFoodItem::select('*')->where('stall_id', $main_stall_id)->paginate(100);

        // ****************start from here********************

           // $cruds = StallFoodItem::orderBy('id','DESC');
        return view('foods.food_items_index',compact('cruds','main_stall_id'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $foodcat =  FoodCat::all();
        $stall_id_print = $request->stall_id_print;
       
        return view('foods.create_stall_food', compact('foodcat', 'stall_id_print'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       
                         
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:150',
            'unit_price' => 'required|max:150',
        
        ]);
 
        if ($validator->fails()) {

          return redirect()->back()->with('message','Please Enter the name and price!');

        }


        $crud = new StallFoodItem($request->input()) ;
     
       // dd($crud);
       
         if($file = $request->hasFile('img')) {
            
            $file = $request->file('img') ;


            //////////////////////// file random name genrator//////////////////////////////////

                        $key = '';
                        $keys = array_merge(range(0, 9), range('a', 'z'));

                        for ($i = 0; $i < 50; $i++) {
                            $key .= $keys[array_rand($keys)];
                        }

             //////////////////////// end file random name genrator//////////////////////////////////
            // $fileName = $file->getClientOriginalName() ;
            $fileName = $key.'.jpeg';

            $destinationPath = '/home/scapikgo/public_html/food_images/';
            $file->move($destinationPath,$fileName);
            $crud->img = $fileName;


        $crud->name = $request->get('name');
        $crud->foodcat_id = $request->get('foodcat_id');
        $crud->unit_price = $request->get('unit_price');
        $crud->available_days = $request->get('available_days');
        $crud->stall_id = $request->get('stall_id');
    
        $crud->desc = $request->get('desc');
        $crud->active = $request->get('active');

     }

            $crud->save() ;

            $main_stall_id = $crud->stall_id;
          
       Session::flash('message', "New Food Item created");
        // return Redirect::back();
        return redirect()->action(
                 'FoodController@index', ['vendor_stall_id' => $main_stall_id]
            );

       
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $crud = StallFoodItem::find($id);

          $foodcat =  FoodCat::all();
        
        return view('foods.edit_stall_food', compact('crud','id','foodcat'));
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
         $crud = StallFoodItem::find($id);

        if($file = $request->hasFile('img')) {
            $file = $request->file('img') ;
            //////////////////////// file random name genrator//////////////////////////////////

                        $key = '';
                        $keys = array_merge(range(0, 9), range('a', 'z'));

                        for ($i = 0; $i < 50; $i++) {
                            $key .= $keys[array_rand($keys)];
                        }

             //////////////////////// end file random name genrator//////////////////////////////////
            // $fileName = $file->getClientOriginalName() ;
            
            $fileName = $key.'.jpeg';
            $destinationPath = '/home/scapikgo/public_html/food_images/';
            $file->storeAs($destinationPath,$fileName );
            $file->move($destinationPath,$fileName);
            $crud->img = $fileName;
          
     }

            $crud->name = $request->get('name');
            $crud->foodcat_id = $request->get('foodcat_id');
            $crud->stall_id = $request->get('stall_id');
            $crud->unit_price = $request->get('unit_price');
            $crud->available_days = $request->get('available_days');
            $crud->desc = $request->get('desc');
            $crud->active = $request->get('active');
            $crud->save();

            $main_stall_id = $crud->stall_id;
    
        Session::flash('message', " Edited * ".$crud['name']. " * food item!  ");
        // return Redirect::back();
        return redirect()->action(
                 'FoodController@index', ['vendor_stall_id' => $main_stall_id]
            );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
           $crud = StallFoodItem::find($id);
           $main_stall_id = $crud['stall_id'];
            $crud->delete();

      Session::flash('delete_message',  " * ".$crud['name']. " * food item Deleted!  ");
        // return Redirect::back();
           return redirect()->action(
                 'FoodController@index', ['vendor_stall_id' => $main_stall_id]
            );
    }
}

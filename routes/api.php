<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::middleware('auth:api')->get('/v1/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('/v1/signup',[
    'uses' => 'UserSignupController@signup',
]);

Route::post('/v1/signin',[
    'uses' => 'UserSignInController@authenticate',
]);




Route::group(['middleware' => ['before' => 'jwt.auth', 'after' => 'jwt.refresh']], function () {
    Route::get('/v1/res1',
        function () {
            $token = JWTAuth::getToken();
            $user = JWTAuth::toUser($token);

            return Response::json([
                'data' => [
                    'email' => $user->email,
                    'registered_at' => $user->created_at->toDateTimeString(),
                    'phone' => 'unknown'
                ]
            ]);
        }
    );

    Route::get('/v1/res2',
        function () {
            $token = JWTAuth::getToken();
            $user = JWTAuth::toUser($token);

            return Response::json([
                'data' => [
                    'email' => $user->email,
                    'registered_at' => $user->created_at->toDateTimeString(),
                    'name' => $user->name,
                ]
            ]);
        }
    );
});

/*
Route::get('/v1/res2', [
    'middleware' => ['before' => 'jwt.auth', 'after' => 'jwt.refresh'],
    function () {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        return Response::json([
            'data' => [
                'email' => $user->email,
                'registered_at' => $user->created_at->toDateTimeString()
            ]
        ]);
    }
]);
*/

// Profile Creation CRUD

Route::get('/profile/{id?}', "ProfileCreationController@index");


 Route::post('/profile/store', "ProfileCreationController@store");
 Route::post('/profile/{id?}/update', "ProfileCreationController@update");
// Route::post('/profile/{id?}/delete', "ProfileCreationController@destroy");





//CRUD
Route::get('/v1/address/{id?}', "AddressController@index");
Route::post('/v1/address/store', "AddressController@store");  //not working
Route::post('/v1/address/{id}/update', "AddressController@update");
Route::post('/v1/address/{id}/delete', "AddressController@destroy");


//CRUD
Route::get('/v1/venues/{id?}', "VenueController@index");
Route::post('/v1/venues/store', "VenueController@store");
Route::post('/v1/venues/{id}/update', "VenueController@update");
Route::post('/v1/venues/{id}/delete', "VenueController@destroy");
//extension
Route::get('/v1/venues/{id}/courts', "VenueController@getVenueCourts");

//CRUD
Route::get('/v1/vendors/{id?}', "VendorController@index");
Route::post('/v1/vendors/store', "VendorController@store");
Route::post('/v1/vendors/{id}/update', "VendorController@update");
Route::post('/v1/vendors/{id}/delete', "VendorController@destroy");

//CRUD
Route::get('/v1/courts/{id?}', "CourtController@index");
Route::post('/v1/courts/store', "CourtController@store");
Route::post('/v1/courts/{id}/update', "CourtController@update");
Route::post('/v1/courts/{id}/delete', "CourtController@destroy");
//extension
Route::get('/v1/courts/{id}/menu', "CourtController@getCourtMenu");
Route::get('/v1/courts/{id}/stalls', "CourtController@getCourtStalls");

//CRUD
Route::get('/v1/stalls/{id?}', "StallController@index");
Route::post('/v1/stalls/store', "StallController@store");
Route::post('/v1/stalls/{id}/update', "StallController@update");
//extension
//stall menu
Route::get('/v1/stalls/{id}/menu/{menuitem_id?}', "StallController@getStallMenu");  //menuitem_id = tbl:stall_food_item, col:id
Route::post('/v1/stalls/{id}/menu/add', "StallController@addStallMenuItem");
Route::post('/v1/stalls/{id}/menu/{menuitem_id}/update', "StallController@updateStallMenuItem");
Route::post('/v1/stalls/{id}/menu/{menuitem_id}/delete', "StallController@deleteStallMenuItem");
//stall orders
Route::get('/v1/stalls/{id}/orders', "OrderController@stallorders");
Route::post('/v1/stalls/{id}/orders/{comp_order_id}/delivered', "OrderController@OrderDelivered");
Route::get('/v1/stalls/{id}/orders/history', "StallController@getOrderHistory");

//CRUD
Route::get('/v1/foodcats/{id?}', "FoodCatController@index");
Route::post('/v1/foodcats/store', "FoodCatController@store");
Route::post('/v1/foodcats/{id}/update', "FoodCatController@update");
Route::post('/v1/foodcats/{id}/delete', "FoodCatController@destroy");
    
//order management
Route::get('/v1/orders/{code}', "OrderController@Order");
Route::post('/v1/orders/store', "OrderController@store");
Route::post('/v1/orders/update_del', "OrderController@OrderDelivered");
Route::post('/v1/orders/{comp_order_id}/pay', "OrderController@OrderPaymentMade");




// users oders history

Route::get('/v1/user/{id}/orders', "OrderController@userOrders");



/*
Route::get('/v1/fooditems/{id?}', "FoodItemController@index");
Route::post('/v1/fooditems/store', "FoodItemController@store");
Route::post('/v1/fooditems/update/{id}', "FoodItemController@update");
Route::post('/v1/fooditems/delete/{id}', "FoodItemController@destroy");
*/


//vendor login apis


//vendor_login_api
Route::post('/vendor_authenticate',[
    'uses' => 'VendorApiAuthController@authenticate',
]);


//sub_login_api
Route::post('/sub_vendor_authenticate',[
    'uses' => 'SubVendorApiAuthController@authenticate',
]);



//Payment Refund Route


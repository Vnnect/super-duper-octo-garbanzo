<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/qr/test/{number}', 'TestController@qrCodeTest');
Route::get('/qrcode/{ordernumber}', 'TestController@qrCode');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/v1/auth/facebook', 'Auth\ApiAuthController@redirectToFacebook');
//Route::get('auth/facebook/callback', 'Auth\AuthController@handleFacebookCallback');


Route::get('/v1/facebook/callback', 'Auth\ApiAuthController@handleFacebookCallback');

/*
Route::post('/v1/facebook/callback', function() {

    //$credentials = Input::only('email', 'password');
    //if (!$token = JWTAuth::attempt($credentials)) {
        //  return Response::json(false, \Illuminate\Http\Response::HTTP_UNAUTHORIZED);
    //}

    $token = 'here';
    return Response::json(compact('token'));
});

*/


Route::resource('new_address', 'VendorAddressController');
Route::resource('new_vendor', 'CreateVendorController');
Route::resource('new_venue', 'CreateVenueController');
Route::resource('new_court', 'CreateCourtController');




//display vendor info
Route::get('display_vendor', 'DisplayVendorController@getData');
//display vendor delete
Route::get('/vendor_delete/{id}', 'DisplayVendorController@destroy');
Route::get('/vendor_edit/{id}', 'DisplayVendorController@editDataForUpdate')->name('edit');
Route::post('/vendor_update', 'DisplayVendorController@updateData')->name('update');


//stall creation
Route::resource('new_stall', 'CreateStallController');
Route::get('display_stall', 'CreateStallController@DisplayStall');

// ################################################################################################################

//login regesteration for vendor and sub vendor

Route::get('/vendor_home', function(){
	return view('vendor_login.vendor_home');
})->name('vendor_home');


Route::get('/sub_vendor_home', function(){
	return view('vendor_login.sub_vendor_home');
})->name('sub_vendor_home');


//vendor login register
Route::get('vendor_login_register', 'VendorAuth\RegisterVendorLoginController@showRegistrationForm');
Route::post('vendor_login_register', 'VendorAuth\RegisterVendorLoginController@register');

//sub vendor login register
Route::get('sub_vendor_login_register', 'VendorAuth\RegisterSubVendorController@showRegistrationForm');
Route::post('sub_vendor_login_register', 'VendorAuth\RegisterSubVendorController@register');


//vendor login
Route::get('vendor_login', 'VendorAuth\VendorLoginController@showLoginForm');
Route::post('vendor_login', 'VendorAuth\VendorLoginController@login');
Route::post('vendor_logout', 'VendorAuth\VendorLoginController@logout');


//sub vendor login
Route::get('sub_vendor_login', 'VendorAuth\SubVendorLoginController@showLoginForm');
Route::post('sub_vendor_login', 'VendorAuth\SubVendorLoginController@login');

Route::get('/sub_vendor_home', function(){
	return view('vendor_login.sub_vendor_home');
});



//vendor relationship
Route::get('vendor_relationship', 'VendorAuth\VendorRelationshipController@index');
Route::post('vendor_relationship', 'VendorAuth\VendorRelationshipController@store');


//vendor food crud
Route::resource('foods','VendorStallFoodController');
Route::post('foods/changeStatus', array('as' => 'changeStatus', 'uses' => 'VendorStallFoodController@changeStatus'));

// Route::post('foods','VendorStallFoodController@index'); 

//Admin Login
Route::get('admin_login', 'AdminLoginController@showLoginForm');
Route::post('admin_login', 'AdminLoginController@login');



//crud remake for food and image
Route::resource('stall_foods', 'FoodController');

Route::post('stall_foods_add', 'FoodController@store');
Route::post('stall_foods_subvendor', 'FoodIndex@index'); //from vendor_login to view sub vendor stall
Route::post('stall_foods_re', 'FoodIndex@index'); //coming from the vendor_login

//send id to store food 
Route::post('stall_foods_id', 'FoodController@create');

//excel import
Route::post('downloadExcel', 'MaatwebsiteDemoController@downloadExcel');


// Social Auth
Route::get('auth/social', 'Auth\SocialAuthController@show')->name('social.login');
Route::get('oauth/{driver}', 'Auth\SocialAuthController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\SocialAuthController@handleProviderCallback')->name('social.callback');


//PaymentRefund Route

Route::get('PaymentRefund/{id?}', 'RefundPaymentController@get');
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
//  Api for user android
$router->post('/userlogin','OtpController@postLogin');
$router->post('/usersignup','AuthController@postLogin');
$router->post('/userupdateprofile','UserProfileController@updateprofile');
$router->post('/userviewprofile','UserProfileController@viewprofile');
$router->post('/changepass','PasswordController@index');

$router->post('/updatepass','PasswordController@update');
// });
$router->post('/userlogstatus','UserLogController@userlog');


$router->post('/userupdateaddress','UserProfileController@updateprofile');
$router->post('/deleteaddress','UserProfileController@delete');

$router->post('/supplierlogin','OtpSupplierController@postLogin');
$router->post('/suppliersignup','AuthSupplierController@postLogin');
$router->post('/supplierchangepass','SupplierPasswordController@index');
// $router->group(['middleware' => "auth"],function($router){
$router->post('/supplierupdatepass','SupplierPasswordController@update');
// });
$router->get('/product','ProductController@index');

$router->post('/user_search','UserSearchController@store');


$router->post('/push_notification_android_cartitemcount', 'FcmnotificationController@pushnotificationandroidCartitemcount');


// end ------------------------

$router->get('/userlist','UserController@index');
$router->post('/userlist/store','UserController@store');
$router->post('/userlist/update','UserController@update');

$router->post('/useraddresslist','UseraddressController@index');
$router->post('/useraddress','UseraddressController@store');

$router->post('/updateaddress','UseraddressController@update');

$router->post('/userlog','UserLogController@userlog');
$router->post('/deleteuser/{id}','UserController@delete');

$router->get('/driverlist','DriverController@index');
$router->post('/driverlist/store','DriverController@store');
$router->post('/driverlist/update','DriverController@update');
$router->post('/deletedriver/{id}','DriverController@delete');
$router->post('/driver/login','DriverLoginController@postLogin');

$router->post('/supplierlist/store','SupplierController@store');
$router->get('/supplierlist','SupplierController@index');
$router->post('/supplierlist/update','SupplierController@update');
$router->post('/supplierlist/updatesupplierprofile','SupplierController@update');
$router->post('/supplierlist/viewsupplierprofile','SupplierController@viewprofile');
$router->post('/deletesupplier/{id}','SupplierController@delete');

//Supplier vacation update
$router->post('/supplierlist/vacationupdate','SupplierController@vacationupdate');

$router->post('/shoplist/store','ShopController@store');
$router->post('/shop/detail','ShopController@shopDetail');
$router->post('/shoplist/update','ShopController@update');
$router->post('/deleteshop/{id}','ShopController@delete');
$router->post('/shoplist/update_shop','ShopController@shop_update_android');
$router->get('/shop_data/','ShopController@particularshopdetail');

$router->post('/accountlist/store','AccountController@store');
$router->post('/account/detail','AccountController@accountDetail');
$router->post('/accountlist/update','AccountController@update');
$router->post('/deleteaccount/{id}','AccountController@delete');
$router->post('/accountlist/update_account','AccountController@account_update_android');
$router->get('/shoplist','ShopController@index');
$router->get('/accountlist','AccountController@index');


//Get user detail for api
$router->get('/api/users/detail/{id}', 'UserController@userDetail');



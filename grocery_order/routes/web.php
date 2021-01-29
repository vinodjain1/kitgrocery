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

// application  api
$router->post('add','SupplierController@test');
$router->post('Api/add-to-cart','Api\AddCartController@store');
$router->post('Api/mycart_product','Api\AddCartController@index');
$router->post('Api/checkout/cart','Api\AddCartController@usercarts');
$router->post('Api/changestatus','Api\OrderController@changeStatus');


$router->post('Api/order_item','Api\OrderController@store');
$router->post('Api/payment','Api\PaymentController@store');
$router->get('/supplierorderlist','SupplierController@index');
$router->post('/orderupdatestatus','SupplierController@updatestatus');
$router->post('/orderupdatestatusinternal','SupplierController@orderupdatestatusinternal');
$router->post('/addcoupon','CouponController@add');

$router->post('/add_coupon','CouponController@add_coupon');
$router->get('/couponlist','CouponController@index');

$router->post('Api/payment_status','Api\PaymentStatusController@store');
$router->post('Api/order_list','Api\OrderListController@list');
$router->post('Api/withdrawalupdatestatus','Api\PaymentController@request');
$router->get('Api/withdrawalrequest','Api\PaymentController@index');

$router->post('Api/supplier_complete_order','Api\SupplierCompleteOrderController@list');
$router->post('Api/supplier/today/sale','Api\SupplierCompleteOrderController@todaySale');
$router->post('Api/supplier/order/list','Api\SupplierCompleteOrderController@orderList');
$router->get('Api/supplier_complete_order_list','Api\SupplierCompleteOrderController@complete_order_list');
$router->post('Api/assign_driver_porduct','Api\AssignProductController@assign');


//Get pending order list for dirver
$router->post('Api/driver/order/pending', 'Api\OrderListController@orderlistPending');
$router->post('Api/driver/order/orderaccept', 'Api\OrderListController@orderaccept');
$router->post('Api/driver/order/detail', 'Api\OrderListController@driverorderDetail');
//Update order status.
$router->post('Api/driver/order/status', 'Api\OrderListController@orderstatusupdate');
//Get all completed order list
$router->post('Api/driver/order/completed', 'Api\OrderListController@orderlistCompleted');


//Supplier wallet api's
$router->post('Api/supplier/walletamount', 'Api\OrderListController@walletamount');
$router->post('Api/supplier/tranaction_request', 'Api\OrderListController@transactionRequesttoAdmin');
$router->post('Api/supplier/tranaction_request_list', 'Api\OrderListController@transactionRequestlist');


//Supplier order detail api
$router->post('Api/supplier/order/detail','Api\SupplierCompleteOrderController@orderdetail');




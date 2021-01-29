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

$router->post('Api/payment','Api\PaymentController@store');
$router->post('wallet/payment/list','Api\PaymentController@index');
$router->post('Api/withdrawalupdatestatus','Api\PaymentController@request');




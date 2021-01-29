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

$router->get('/shoplist','ShopController@index');
$router->post('/shoplist/store','ShopController@store');
$router->post('/shoplist/update','ShopController@update');
$router->post('/deleteshop/{id}','ShopController@delete');

$router->get('/accountlist','AccountController@index');
$router->post('/accountlist/store','AccountController@store');
$router->post('/accountlist/update','AccountController@update');
$router->post('/deleteaccount/{id}','AccountController@delete');

$router->get('/productlist','ProductController@index');
$router->post('/productlist/store','ProductController@store');
$router->post('/productlist/update','ProductController@update');
$router->get('/productlist1','ProductController@index1');
$router->post('/deleteproduct/{id}','ProductController@delete');

$router->get('/variantlist','VariantController@index');
$router->post('/variantlist/search','VariantController@search');
$router->post('/variantlist/store','VariantController@store');
$router->post('/variantlist/update','VariantController@update');

$router->get('/inventorylist','InventaryController@index');
$router->post('/inventorylist/store','InventaryController@store');
$router->post('/inventorylist/update','InventaryController@update');

$router->post('/variantautofill','VariantController@autofill');

$router->get('/unitamount/{id}','VariantController@unitamount');

$router->get('/citylist','CityController@index');
$router->post('/citylist/store','CityController@store');
$router->post('/citylist/update','CityController@update');

$router->get('/cityapi','CityApiController@api');

// api for mobile
$router->get('/api/cityapi','Api\ProuctController@index');






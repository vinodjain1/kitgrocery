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
$router->get('/categorylist','CategoryController@index');
$router->post('/categorylist/store','CategoryController@store');
$router->post('/categorylist/update','CategoryController@update');
$router->post('/deletecate/{id}','CategoryController@delete');

$router->get('/subcategorylist','SubCategoryController@index');
$router->post('/subcategorylist/store','SubCategoryController@store');
$router->post('/subcategorylist/update','SubCategoryController@update');
$router->post('/deletesubcate/{id}','SubCategoryController@delete');

$router->get('/brandlist','BrandController@index');
$router->post('/brandlist/store','BrandController@store');
$router->post('/brandlist/update','BrandController@update');
$router->post('/deletebrand/{id}','BrandController@delete');

$router->get('/bannerlist','BannerController@index');
$router->post('/banner/store','BannerController@store');
$router->post('/banner/update','BannerController@update');
$router->post('/banner/{id}','BannerController@delete');

$router->get('/citylist','CityController@index');
$router->post('/citylist/store','CityController@store');
$router->post('/citylist/update','CityController@update');
$router->post('/deletecity/{id}','CityController@pincodedelete');
$router->post('/pincode_service','CityController@pincode_service');

$router->get('/pincodelist','CityController@pincode');
$router->post('/pincodelist/store','CityController@pincodestore');
$router->post('/pincodelist/update','CityController@pincodeupdate');
$router->post('/deletepincodelist/{id}','CityController@pincodedelete');
$router->get('/Api/pin_codelist','ZoneController@pincodelist');
$router->post('/pincode/update','CityController@pincode_update');

$router->get('/productlist','ProductController@index');
$router->post('/productlist/store','ProductController@store');
$router->post('/productlist/update','ProductController@update');
$router->get('/productlist1','ProductController@index1');
$router->post('/deleteproduct/{id}','ProductController@delete');

$router->get('/supplierproductlist','SupplierproductController@index');
$router->get('/supplierproductlistadmin','SupplierproductController@admin');
$router->post('/supplierproductlist/store','SupplierproductController@store');
$router->post('/supplierproductlist/update','SupplierproductController@update');
$router->get('/supplierproductlist1','SupplierproductController@index1');
$router->post('/supplierdeleteproduct/{id}','SupplierproductController@delete');
// $router->group(['middleware' => "auth"],function($router){
  $router->post('/supplier_indivisul_product','SupplierproductController@indivisul');  
// });


$router->post('/supplierproductlist/store','SupplierproductController@store');


$router->get('/variantlist','VariantController@index');
$router->post('/suppliervariantlist/suppliersearch','VariantController@suppliersearch');
$router->get('/supplierproduct/product','VariantController@productdetail');
$router->post('/variantlist/search','VariantController@search');
$router->post('/variantlist/store','VariantController@store');
$router->post('/variantlist/update','VariantController@update');

$router->get('/inventorylist','InventaryController@index');
$router->post('/inventorylist/store','InventaryController@store');
$router->post('/inventorylist/update','InventaryController@update');
$router->post('updatestatus','InventaryController@updatestatus');

$router->post('/variantautofill','VariantController@autofill');
$router->post('/deleteinventory/{id}','VariantController@delete');

$router->get('/unitamount/{id}','VariantController@unitamount');

// $router->get('/inventarylist1', function () use ($router) {
//     return $router->app->version();
// });


$router->get('/citylist','CityController@index');
$router->post('/citylist/store','CityController@store');
$router->post('/citylist/update','CityController@update');
$router->get('/pincodelist','CityController@pincode');

$router->get('/cityapi','CityApiController@api');
$router->get('/zone','ZoneController@index');
$router->post('/zone/store','ZoneController@store');
$router->post('/zone/assign_zone','ZoneController@assignzone');
$router->get('/Api/pin_code','ZoneController@requestpincode');


// application  api
$router->post('Api/product','ProductController@index');
$router->post('Api/product_list','Api\ProductController@searchlist');
$router->post('Api/searchlistcategory','Api\SearchListCategory@searchlistcategory');
$router->post('Api/search_list_product','Api\ProductController@search_list_product');

$router->post('Api/productsearch','Api\ProductController@productsearch');
$router->post('Api/supplierproductsearch','Api\ProductController@supplierproductsearch');
$router->post('Api/searchproduct','Api\SupplierProductController@searchproduct');
$router->post('Api/productsearch_Api','Api\ProductController@productsearch_android');

$router->post('Api/searchproduct1','Api\SupplierProductController@searchproduct1');

$router->post('Api/searchingproduct','Api\ProductController@searchinglist');
// Route::group(['middleware' => ['auth','check-permissions']], function () {
$router->post('Api/deal','Api\DealController@deal');
// });



$router->get('Api/category','Api\CategoryController@index');
$router->get('Api/sub-category','Api\SubcategoryController@index');

$router->post('Api/add-supplierproduct','Api\ProductController@store');

// $router->post('Api/add_supplier_product','Api\SupplierProductController@store');
// $router->post('Api/add_supplierproduct','Api\SupplierProductController@androidstore');


//Get product detail for oder
$router->get('/api/products/detail/{id}', 'ProductController@orderproductDetail');




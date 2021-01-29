<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Api\Product;
use App\Supplierproduct;
use App\Inventary;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

header('Access-Control-Allow-Origin:*');
class DealController extends Controller
{
   
     public function deal(Request $request){
    	$product=DB::table("admin_product_inventary")
    	->join('admin_product','admin_product.product_sku','=','admin_product_inventary.product_sku')
    	->where('city_id','=',$request->city_id)->orWhere('status',$request->status)
    	->select('admin_product_inventary.*','admin_product.product_name','admin_product.featured_image','admin_product.gallery_image')
    	->get();
    // 	echo "<pre>";print_r($product);die;
      	if(count($product) == 0){
      	   	$data['success'] = 201;
            $data['message'] = 'product not found';
            return response()->json(compact('data'));
      	}else{
      	     $data['success'] = 200;
        	$data['message'] = 'list of product';
            return response()->json([
                'product' => $product,
                
            ]);
    	
    	}
   
    }

}
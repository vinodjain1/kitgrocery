<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class SubcategoryController extends Controller
{
   
     public function index(Request $request){

    	$subcategory=DB::table("admin_product_sub_category")
    	->join('admin_product_category','admin_product_category.product_category_id','=','admin_product_sub_category.product_category_id')
    	->orderBy('admin_product_sub_category.id','DESC')->get();
      	if($subcategory == null){
    		$data['success'] = 200;
         $data['message'] = 'categroy not found';
        return response()->json(compact('data'));
    	}
    	$data['success'] = 200;
    	$data['message'] = 'list of category';


        return response()->json([
            'sub_category' => $subcategory,
            
        ]);
   
    }
 
    
}
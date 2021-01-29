<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class CategoryController extends Controller
{
   
     public function index(Request $request){

    	$category=DB::table("admin_product_category")->orderBy('admin_product_category.id','DESC')->get();
      	if($category == null){
    		$data['success'] = 200;
         $data['message'] = 'categroy not found';
        return response()->json(compact('data'));
    	}
    	$data['success'] = 200;
    	$data['message'] = 'list of category';


        return response()->json([
            'category' => $category,
            
        ]);
   
    }
 
    
}
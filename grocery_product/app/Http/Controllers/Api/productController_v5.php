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
   
    //  public function index(Request $request){

    // 	$category=DB::table("admin_product_category")->orderBy('admin_product_category.id','DESC')->get();
    //   	if($category == null){
    // 		$data['success'] = 200;
    //      $data['message'] = 'categroy not found';
    //     return response()->json(compact('data'));
    // 	}
    // 	$data['success'] = 200;
    // 	$data['message'] = 'list of category';


    //     return response()->json([
    //         'category' => $category,
            
    //     ]);
   
    // }
    
    
    
     public function index(Request $request){
       
      
      
    //   $results = DB::select( DB::raw("select api.product_category_id,api.product_category_name,api.id,api.category_featured_image,
    //     apsc.product_sub_category_name
        
    //   left join admin_product_sub_category apsc on apsc.product_category_id = api.product_category_id 
    // "));
        
        $results=DB::table('admin_product_category')
       
        ->get();
        
        $jsonResult = array();
        $i = -1;
         $previous_p_id = 0;
         $sub_cat=array();
        foreach($results as $result){
            $cat =  $result->product_category_id;
             $result1=DB::table('admin_product_sub_category')->where('product_category_id',$cat)->get();
               $sub_cat=array(); 
            foreach($result1 as $cat_value){
                       array_push($sub_cat,array(
                'product_sub_category_id'=>$cat_value->product_sub_category_id,
                 'product_sub_category_name'=>$cat_value->product_sub_category_name,
                ));
            }
          
            if($previous_p_id != $result->id){
                 $i++;
                 array_push($jsonResult,array(
                'product_category_id'=>$result->product_category_id,
                'product_category_name'=>$result->product_category_name,
                'category_image'=>$result->category_featured_image,
                'sub_category'=>$sub_cat
                ));
                 
            }
            
          
           
         
        }
         
        return response()->json(array("category"=>$jsonResult));
        
    }
}
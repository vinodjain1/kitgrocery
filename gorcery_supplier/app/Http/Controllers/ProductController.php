<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\Product;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class ProductController extends Controller
{
   public function index(){

    	$product=DB::table("supplier_product")->orderBy('supplier_product.id','DESC')->get();
    
    // 	echo"<pre>";print_r($product);die;
    	if($product == null){
    		$data['success'] = 200;
         $data['message'] = 'product not found';
        return response()->json(compact('data'));
    	}
    	
    	$data['success'] = 200;
    	$data['message'] = 'list of category';

        
        return response()->json($product);
   
    }
    
       public function index1(){
        	$product=DB::table("admin_product")
    	->join('admin_product_category','admin_product.product_category_id','=', 'admin_product_category.product_category_id')
    	->select('admin_product.*','admin_product_category.*')
    	->orderBy('admin_product.id','DESC')->first();
    
    // 	echo"<pre>";print_r($product);die;
    	if($product == null){
    		$data['success'] = 200;
         $data['message'] = 'product not found';
        return response()->json(compact('data'));
    	}
    	
    	$data['success'] = 200;
    	$data['message'] = 'list of product';

        
        return response()->json($product);
   
    }
    
    
     public function store(Request $request)
 {
       $arr = $request->all();
              $validator = Validator::make($request->all(), [
                    'product_name' => 'required',
                ]);
               if ($validator->fails()) {
                return response()->json(['status'=>202,'success'=>'category name required.']);
            }else{
           
            $checker = Product::select('product_name','supplier_id')->where('product_name',$request->product_name)
            ->where('supplier_id',$request->supplier_id)
            ->exists();    
         	if($checker > 0){
         	return response()->json(['status'=>201,'success'=>'sub category already exist.']);
         	}
         	else{
         	
            $string  = $request->product_name;
            $result = substr($string, 0, 2);
            $str=strtoupper($result);
            $ran = $request->product_id.$str;
            $arr['product_id'] = $ran;
            
            Product::create($arr);
           
             return response()->json(['status'=>200,'success'=>'supplier saved successfully.']);
             	 }
            }
            
 }
  public function update(Request $request)
 {
       $arr = $request->all();
       Product::find($request->id)->update($arr);
       return response()->json(['status'=>200,'success'=>'shop detail update successfully.']);
 }
     public function delete($id)
    {
        $delete = Product::where('id', $id)->delete();

        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "User deleted successfully";
        } else {
            $success = true;
            $message = "User not found";
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
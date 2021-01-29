<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\Supplierproduct;
use App\Inventary;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class SupplierproductController extends Controller
{
   public function index(){


    	$product=DB::table("supplier_product")
    	->join('admin_product_inventary','admin_product_inventary.s_id','=','supplier_product.id')
    	->select('supplier_product.*','admin_product_inventary.s_id')
    	->get();
    
    	if($product == null){
    		return response()->json(['status'=>0,'error'=>'data not fount.']);
    	}
    return response()->json(['status'=>1,'success'=>'data foun.','data'=>$product]);
   
    }
       public function admin(){


    	$product=DB::table("supplier_product")
    	->join('admin_product_inventary','admin_product_inventary.s_id','=','supplier_product.id')
    	->select('supplier_product.*','admin_product_inventary.inventory_id','admin_product_inventary.s_id')
    	->get();
    
    	if($product == null){
    		$data['success'] = 200;
         $data['message'] = 'product not found';
        return response()->json(compact('data'));
    	}
    	
    	$data['success'] = 200;
    	$data['message'] = 'list of product';

        
        return response()->json($product);
   
    }
   
    
    public function indivisul(Request $request){


    	$product=DB::table("supplier_product")
    	->join('admin_product_category','admin_product_category.product_category_id','=','supplier_product.product_category_id')
    	->join('admin_product_sub_category','admin_product_sub_category.product_sub_category_id','=','supplier_product.product_sub_category_id')
    	->join('admin_product_inventary','admin_product_inventary.s_id','=','supplier_product.id')
    	->join('brand_table','brand_table.brand_id','=','supplier_product.brand_id')
    	->select('supplier_product.*','admin_product_category.product_category_name','admin_product_category.category_featured_image','admin_product_sub_category.product_sub_category_name','admin_product_inventary.inventory_id')->where('supplier_product.supplier_id','=',$request->supplier_id)
    	->get();
    
    	if($product == null){
    		return response()->json(['status'=>0,'error'=>'data not fount.']);
    	}
    	return response()->json(['status'=>1,'success'=>'data foun.','data'=>$product]);
   
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
       
        $checker = Supplierproduct::select('variant_sku','supplier_id')->where('variant_sku',$request->variant_sku)
        ->where('supplier_id',$request->supplier_id)
        ->exists();    
     	if($checker > 0){
     	return response()->json(['status'=>201,'success'=>'this sku product already exist.']);
     	}
     	else{
     	$cat_id = rand(1000,1000000000);
        $string  = $request->product_name;
        $result = substr($string, 0, 2);
        $str=strtoupper($result);
        $ran = $cat_id.$str;
        $arr['supplier_product_id'] = $ran;
        $arr['product_quantity'] = $request->total_quantity_offered;
         $id = Supplierproduct::create($arr)->id;
         
         if(!empty($id)){
               
            	$cat_id1 = rand(1000,1000000000);
                $string1  = $request->product_name;
                $result1 = substr($string1, 0, 2);
                $str1=strtoupper($result1);
                $ran1 = $cat_id1.$str1;
             	$arr['inventory_id'] = $ran1;
             	$arr['s_id'] = $id;
                $arr['availability'] = $request->total_quantity_offered;
              
			Inventary::create($arr);
			}
		
         return response()->json(['status'=>200,'success'=>'product saved successfully.']);
         	 }
        }
            
 }
  public function update(Request $request)
 {
                 $arr = $request->all();
                  $arr['availability'] = $request->total_quantity_offered;
                //   echo $request->supplier_product_id;die;
                 $query = Inventary::where('inventory_id', $request->inventory_id)->update([
                      'mrp' => $request->mrp,
                      'discount_type' => $request->discount_type,
                      'discount_amount' => $request->discount_amount,
                      'availability' => $request->total_quantity_offered
                      
                      ]);
                    //   echo "<pre>";print_r($query);die;
              if($query > 0){
                
                 $query1 = Supplierproduct::where('supplier_product_id', $request->supplier_product_id)->update([
                      'expiry_date' => $request->expiry_date,
                      'mrp' => $request->mrp,
                      'discount_type' => $request->discount_type,
                      'discount_amount' => $request->discount_amount,
                      'total_quantity_offered' => $request->total_quantity_offered
                      
                      ]);
                    //   echo "<pre>";print_r();die;
               if($query1 > 0){
                  return response()->json(['status'=>200,'success'=>'product update successfully.']);
               }else{
                      return response()->json(['status'=>201,'success'=>'not updated.']);
               }
              }
       return response()->json(['status'=>201,'success'=>'not updated.']);
     
      
 }
     public function delete($id)
    {
        $delete1 =  Supplierproduct::where('id', $id)->delete();
        if($delete1 == 1){
         $delete = Inventary::where('id', $id)->delete();
        
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
}
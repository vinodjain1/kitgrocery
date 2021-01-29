<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\Variant;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class VariantController extends Controller
{
   public function index(){

    	$product=DB::table("admin_product_variant")
    	->join('admin_product','admin_product.product_id','=', 'admin_product_variant.product_id')
    	->select('admin_product_variant.*','admin_product.product_name')
    	->orderBy('admin_product_variant.id','DESC')->get();
    
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
     public function store(Request $request)
 {
             $arr = $request->all();
              $validator = Validator::make($request->all(), [
                    'unit_amount' => 'required',
                ]);
               if ($validator->fails()) {
                return response()->json(['status'=>202,'success'=>'category name required.']);
            }else{
             $cat_id = rand(1000,1000000000); 
            $string  = $request->unit_type;
            $result = substr($string, 0, 2);
            $str=strtoupper($result);
            $ran = $cat_id.$str;
            $sku = $str.$cat_id;
            $arr['variant_id'] = $ran;
            $arr['variant_sku'] = $sku;
            
            Variant::create($arr);
             return response()->json(['status'=>200,'success'=>'supplier saved successfully.']);
            }   
            
 }
 public function update(Request $request)
 {
            $arr = $request->all();
            
             Variant::find($request->id)->update($arr);
       return response()->json(['status'=>200,'success'=>'user update successfully.']);
 }
 public function autofill(Request $request){
   
      $query = $request->product_name;
      $data = DB::table('admin_product')
      ->join('admin_product_variant','admin_product_variant.product_sku','=','admin_product.product_sku')
    //   ->join('admin_product_inventary','admin_product_inventary.variant_sku','!=','admin_product_variant.variant_sku')
      ->select('admin_product.*','admin_product_variant.product_sku','admin_product_variant.variant_sku','admin_product_variant.unit_type','admin_product_variant.unit_amount')
        ->where('product_name', 'LIKE', "%{$query}%")->orWhere('unit_type', 'LIKE', "%{$query}%")->orWhere('unit_amount', 'LIKE', "%{$query}%")
        ->orWhere('variant_sku', 'LIKE', "%{$query}%")
        ->get();
      $output = '<ul class="dropdown-menu" style="display:block; position:relative;width:100%">';
      foreach($data as $row)
      {
       $output .= '
       <li>'.$row->product_name.'&nbsp;&nbsp;'.$row->unit_type.'&nbsp;&nbsp;'.$row->unit_amount.'&nbsp;&nbsp;sku '.$row->variant_sku.'</li>
       ';
      }
      $output .= '</ul>';
      echo $output;  
 }
  public function search(Request $request)
    {
         $var_sku = $request->variant_sku;
         $product=DB::table("admin_product_variant")->where('variant_sku','=',$var_sku)->get();
          foreach($product as $value){
                 $arr['product_sku'] = $value->product_sku; 
                 $arr['v_sku'] = $value->variant_sku; 
                 
             }
             $product_sku = $arr['product_sku'];
             $v_sku = $arr['v_sku'];
             return response()->json(['status'=>200,'success'=>'supplier saved successfully.','product_sku'=>$product_sku,'v_sku'=>$v_sku]);
    }
    
 public function suppliersearch(Request $request)
   {
         $var_sku1 = $request->product_name;
        
         $subString = strrchr($var_sku1, 'sku');
        //  echo $subString;die;
         $var_sku = substr($subString, strrpos($subString, ' ') + 1);
        //  echo $var_sku;die;
         $product=DB::table("admin_product_variant")->where('variant_sku','=',$var_sku)->get();
          foreach($product as $value){
                 $arr['product_sku'] = $value->product_sku; 
                 $arr['v_sku'] = $value->variant_sku; 
             }
             $product_sku = $arr['product_sku'];
             $v_sku = $arr['v_sku'];
             return response()->json(['status'=>200,'success'=>'supplier saved successfully.','product_sku'=>$product_sku,'v_sku'=>$v_sku]);
    }
    
    public function productdetail(){

    	$product=DB::table("admin_product")
    	->join('admin_product_category','admin_product_category.product_category_id','=', 'admin_product.product_category_id')
    	->join('admin_product_sub_category','admin_product_sub_category.product_sub_category_id','=', 'admin_product.product_sub_category_id')
    	->join('brand_table','brand_table.brand_id','=', 'admin_product.brand_id')
    	->join('admin_product_variant','admin_product_variant.product_sku','=', 'admin_product.product_sku')
    	->select('admin_product.*','admin_product_category.product_category_id',
    	'admin_product_category.product_category_name','admin_product_sub_category.product_sub_category_id',
    	'admin_product_sub_category.product_sub_category_name','brand_table.brand_id','brand_table.brand_name','admin_product_variant.variant_id',
    	'admin_product_variant.unit_amount','admin_product_variant.variant_sku','admin_product_variant.unit_type')
    	->orderBy('admin_product.id','DESC')->get();
    
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
   
}
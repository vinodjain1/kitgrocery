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
   /*public function index(){ 

    	$product=DB::table("admin_product")
    	->join('admin_product_category','admin_product.product_category_id','=', 'admin_product_category.product_category_id')
    	->join('admin_product_sub_category','admin_product.product_sub_category_id','=', 'admin_product_sub_category.product_sub_category_id')
    	->join('brand_table','admin_product.brand_id','=', 'brand_table.brand_id')
    	->select('admin_product.*','admin_product_category.product_category_name','admin_product_sub_category.product_sub_category_name','brand_table.brand_name')
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
   
    }*/
    
    public function index(Request $request){
   $results = DB::select( DB::raw("select api.product_id,api.product_sku,ap.product_name,ap.featured_image,ap.brand_id,ap.description,apc.product_category_name,apc.category_featured_image,
        apsc.product_sub_category_name,api.variant_id,api.variant_sku,api.supplier_id,api.status,api.unit_type,api.unit_amount from admin_product_inventary api
       left join admin_product ap on ap.product_id = api.product_id 
       left join admin_product_category apc on apc.product_category_id = ap.product_category_id 
       left join admin_product_sub_category apsc on apsc.product_sub_category_id = ap.product_sub_category_id 
       where api.city_id = :city_id and api.availability > 0 and api.status = 'Hot Deal'
       "), array(
             'city_id' => $request->city_id,
        ));
        $jsonResultHot = array();
        $i = 0;
        $previous_p_id = 0;
        foreach($results as $result){
        
        $jsonResultHot[$i]['product_detail'] = ['product_id'=>$result->product_id,
        'product_sku'=>$result->product_sku,
        'product_name'=>$result->product_name,
        'featured_image'=>$result->featured_image,
        'brand_id'=>$result->brand_id,
        'description'=>$result->description,
        'product_category_name'=>$result->product_category_name,
        'product_sub_category_name'=>$result->product_sub_category_name,
        'category_image'=>$result->category_featured_image,
        ]; 
        
        
        $results_inv = DB::select( DB::raw("select api.product_id,api.product_sku,ap.product_name,ap.featured_image,ap.brand_id,ap.description,apc.product_category_name,apc.category_featured_image,
        apsc.product_sub_category_name,api.variant_id,api.variant_sku,apv.minimum_margin,apv.discount_amount variant_discount_amount,api.supplier_id,api.status,api.unit_type,api.unit_amount,
        (CASE 
         WHEN api.discount_type = 'precentage' THEN (api.mrp * (api.discount_amount/100))
         ELSE api.discount_amount
         END) as final_discount,
         api.discount_amount as dis,
        api.mrp,
        api.inventory_id,
        api.discount_type,api.discount_amount,api.mrp inventory_discount_amount from admin_product_inventary api 
       left join admin_product_variant apv on apv.variant_id = api.variant_id 
       left join admin_product ap on ap.product_id = api.product_id 
       left join admin_product_category apc on apc.product_category_id = ap.product_category_id 
       left join admin_product_sub_category apsc on apsc.product_sub_category_id = ap.product_sub_category_id 
       where api.city_id = :city_id and api.product_id = :product_id and api.availability > 0
       group by api.unit_type, api.unit_amount having Max(final_discount)"), array(
             'city_id' => $request->city_id,
             'product_id' => $result->product_id,
        ));
        
        $inventory_detail = [];
        if(!empty($results_inv)){
        foreach($results_inv as $result_inv){
        
        $inventory_detail[] = ['variant_id'=>$result_inv->variant_id,
        'variant_sku'=>$result_inv->variant_sku,
        'minimum_margin'=>$result_inv->minimum_margin,
        'variant_discount_amount'=>$result_inv->variant_discount_amount,
        'supplier_id'=>$result_inv->supplier_id,
        'mrp'=>$result_inv->mrp,
        'inventory_id'=>$result_inv->inventory_id,
        'discount_type'=>$result_inv->discount_type,
        'status'=>$result_inv->status,
        'unit_type'=>$result_inv->unit_type,
        'unit_amount'=>$result_inv->unit_amount,
        'inventory_discount_amount'=>$result_inv->dis,
        'final_discount'=>$result_inv->final_discount,
        'product_name'=>$result_inv->product_name,
        'product_category_name'=>$result_inv->product_category_name,
        'product_sub_category_name'=>$result_inv->product_sub_category_name,
        'description'=>$result_inv->description,
        'category_image'=>$result_inv->category_featured_image,
        
        ];   
        }
        }
        
        
        $jsonResultHot[$i]['product_detail']['inventory_detail'] = $inventory_detail;
        $i++;
        
        }
        
        
        
        $results = DB::select( DB::raw("select api.product_id,api.product_sku,ap.product_name,ap.featured_image,ap.brand_id,ap.description,apc.product_category_name,apc.category_featured_image,
        apsc.product_sub_category_name,api.variant_id,api.variant_sku,api.supplier_id,api.status,api.unit_type,api.unit_amount from admin_product_inventary api
       left join admin_product ap on ap.product_id = api.product_id 
       left join admin_product_category apc on apc.product_category_id = ap.product_category_id 
       left join admin_product_sub_category apsc on apsc.product_sub_category_id = ap.product_sub_category_id
       where api.city_id = :city_id and api.availability > 0 and api.status = 'Recommended'
       "), array(
             'city_id' => $request->city_id,
        ));
        $jsonResultRecommended = array();
        $i = 0;
        $previous_p_id = 0;
        foreach($results as $result){
        
        $jsonResultRecommended[$i]['product_detail'] = ['product_id'=>$result->product_id,
        'product_sku'=>$result->product_sku,
        'product_name'=>$result->product_name,
        'featured_image'=>$result->featured_image,
        'brand_id'=>$result->brand_id,
        'description'=>$result->description,
        'product_category_name'=>$result->product_category_name,
        'product_sub_category_name'=>$result->product_sub_category_name,
        'category_image'=>$result->category_featured_image,
        ]; 
        
        
        $results_inv = DB::select( DB::raw("select api.product_id,api.product_sku,ap.product_name,ap.featured_image,ap.brand_id,ap.description,apc.product_category_name,apc.category_featured_image,
        apsc.product_sub_category_name,api.variant_id,api.variant_sku,apv.minimum_margin,apv.discount_amount variant_discount_amount,api.supplier_id,api.status,api.unit_type,api.unit_amount,
        (CASE 
         WHEN api.discount_type = 'precentage' THEN (api.mrp * (api.discount_amount/100))
         ELSE api.discount_amount
         END) as final_discount,
         api.discount_amount as dis,
        api.mrp,
        api.inventory_id,
        api.discount_type,api.discount_amount,api.mrp inventory_discount_amount from admin_product_inventary api 
       left join admin_product_variant apv on apv.variant_id = api.variant_id 
       left join admin_product ap on ap.product_id = api.product_id 
       left join admin_product_category apc on apc.product_category_id = ap.product_category_id 
       left join admin_product_sub_category apsc on apsc.product_sub_category_id = ap.product_sub_category_id 
       where api.city_id = :city_id and api.product_id = :product_id and api.availability > 0
       group by api.unit_type, api.unit_amount having Max(final_discount)"), array(
             'city_id' => $request->city_id,
             'product_id' => $result->product_id,
        ));
        $inventory_detail = [];
        if(!empty($results_inv)){
        foreach($results_inv as $result_inv){
        
        $inventory_detail[] = ['variant_id'=>$result_inv->variant_id ? : '109898484GM',
        'variant_sku'=>$result_inv->variant_sku,
        'minimum_margin'=>$result_inv->minimum_margin ? : '10',
        'variant_discount_amount'=>$result_inv->variant_discount_amount ? : '10',
        'supplier_id'=>$result_inv->supplier_id,
        'mrp'=>$result_inv->mrp,
        'inventory_id'=>$result_inv->inventory_id,
        'discount_type'=>$result_inv->discount_type,
        'status'=>$result_inv->status,
        'unit_type'=>$result_inv->unit_type,
        'unit_amount'=>$result_inv->unit_amount,
        'inventory_discount_amount'=>$result_inv->dis,
        'final_discount'=>$result_inv->final_discount,
        'product_name'=>$result_inv->product_name,
        'product_category_name'=>$result_inv->product_category_name,
        'product_sub_category_name'=>$result_inv->product_sub_category_name,
        'description'=>$result_inv->description,
        'category_image'=>$result_inv->category_featured_image,
        
        ];    
        }
        }
        
        
        $jsonResultRecommended[$i]['product_detail']['inventory_detail'] = $inventory_detail;
        $i++;
        }
        
        
          $results = DB::select( DB::raw("select api.product_id,api.product_sku,ap.product_name,ap.featured_image,ap.brand_id,ap.description,apc.product_category_name,apc.category_featured_image,
        apsc.product_sub_category_name,api.variant_id,api.variant_sku,api.supplier_id,api.status,api.unit_type,api.unit_amount from admin_product_inventary api
       left join admin_product ap on ap.product_id = api.product_id 
       left join admin_product_category apc on apc.product_category_id = ap.product_category_id 
       left join admin_product_sub_category apsc on apsc.product_sub_category_id = ap.product_sub_category_id
       where api.city_id = :city_id and api.availability > 0 and api.status = 'Must By'
       "), array(
             'city_id' => $request->city_id,
        ));
        $jsonResultMustBuy = array();
        $i = 0;
        $previous_p_id = 0;
        foreach($results as $result){
        
        $jsonResultMustBuy[$i]['product_detail'] = ['product_id'=>$result->product_id,
        'product_sku'=>$result->product_sku,
        'product_name'=>$result->product_name,
        'featured_image'=>$result->featured_image,
        'brand_id'=>$result->brand_id,
        'description'=>$result->description,
        'product_category_name'=>$result->product_category_name,
        'product_sub_category_name'=>$result->product_sub_category_name,
        'category_image'=>$result->category_featured_image,
        ]; 
        
        
        $results_inv = DB::select( DB::raw("select api.product_id,api.product_sku,ap.product_name,ap.featured_image,ap.brand_id,ap.description,apc.product_category_name,apc.category_featured_image,
        apsc.product_sub_category_name,api.variant_id,api.variant_sku,apv.minimum_margin,apv.discount_amount variant_discount_amount,api.supplier_id,api.status,api.unit_type,api.unit_amount,
        (CASE 
         WHEN api.discount_type = 'precentage' THEN (api.mrp * (api.discount_amount/100))
         ELSE api.discount_amount
         END) as final_discount,
         api.discount_amount as dis,
        api.mrp,
        api.inventory_id,
        api.discount_type,api.discount_amount,api.mrp inventory_discount_amount from admin_product_inventary api 
       left join admin_product_variant apv on apv.variant_id = api.variant_id 
       left join admin_product ap on ap.product_id = api.product_id 
       left join admin_product_category apc on apc.product_category_id = ap.product_category_id 
       left join admin_product_sub_category apsc on apsc.product_sub_category_id = ap.product_sub_category_id 
       where api.city_id = :city_id and api.product_id = :product_id and api.availability > 0
       group by api.unit_type, api.unit_amount having Max(final_discount)"), array(
             'city_id' => $request->city_id,
             'product_id' => $result->product_id,
        ));
        $inventory_detail = [];
        
        if(!empty($results_inv)){
        foreach($results_inv as $result_inv){
        
        $inventory_detail[] = ['variant_id'=>$result_inv->variant_id ? : '109898484GM',
        'variant_sku'=>$result_inv->variant_sku,
        'minimum_margin'=>$result_inv->minimum_margin ? : '10',
        'variant_discount_amount'=>$result_inv->variant_discount_amount ? : '7',
        'supplier_id'=>$result_inv->supplier_id,
        'mrp'=>$result_inv->mrp,
        'inventory_id'=>$result_inv->inventory_id,
        'discount_type'=>$result_inv->discount_type,
        'status'=>$result_inv->status,
        'unit_type'=>$result_inv->unit_type,
        'unit_amount'=>$result_inv->unit_amount,
        'inventory_discount_amount'=>$result_inv->dis,
        'final_discount'=>$result_inv->final_discount,
        'product_name'=>$result_inv->product_name,
        'product_category_name'=>$result_inv->product_category_name,
        'product_sub_category_name'=>$result_inv->product_sub_category_name,
        'description'=>$result_inv->description,
        'category_image'=>$result_inv->category_featured_image,
        
        ];  
        }
        }
        
        
        $jsonResultMustBuy[$i]['product_detail']['inventory_detail'] = $inventory_detail;
        $i++;
        }
        $categories = DB::table('admin_product_category')->get(); 
        if(!empty($categories)){
        return response()->json([
         'status'=>1,
         'message'=>"successfully found data",
         'category' => $categories,
        'hotDeal' => $jsonResultHot,
        'recommende' => $jsonResultRecommended,
        'mustBuy' => $jsonResultMustBuy,
        ]);
        }else{
         return response()->json([
         'status'=>0,
         'message'=>"data not found",
        ]);
        }
        
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
       if($file = $request->file('featured_image')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('../image', $name);
                $path ='https://kamakhyaits.com/grocery_product/public/image/'.$name;
                $arr['featured_image']=$path;
            }
            if($file = $request->file('gallery_image')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('../image', $name);
                $path ='https://kamakhyaits.com/grocery_product/public/image/'.$name;
                $arr['gallery_image']=$path;
            }
           
            $checker = Product::select('product_name')->where('product_name',$request->product_name)->exists();    
         	if($checker == $request->product_name){
         	return response()->json(['status'=>201,'success'=>'product already exist.']);
         	}
         	else{
         	
            $string  = $request->product_name;
            $result = substr($string, 0, 2);
            $str=strtoupper($result);
            $ran = $str.$request->product_sku;
            $prod_sku = $request->product_id;
            $sku = $prod_sku.$str;
            $arr['product_id'] = $sku;
            $arr['product_sku'] = $ran;
            
            Product::create($arr);
             $product=DB::table('admin_product')->select('product_id')->where('product_id','=',$ran)->get();
             foreach($product as $value){
                 $arr['product_id'] = $value->product_id;   
                 
             }
             $id = $arr['product_id'];
             return response()->json(['status'=>200,'success'=>'supplier saved successfully.','id'=>$id]);
             	 }
            }
            
 }
 public function update(Request $request)
 {
      $arr = $request->all();
              $validator = Validator::make($request->all(), [
                    'product_name' => 'required',
                ]);
               if ($validator->fails()) {
                return response()->json(['status'=>202,'success'=>'category name required.']);
            }else{

       if($file = $request->file('featured_image')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('../image', $name);
                $path ='https://kamakhyaits.com/grocery_user/public/image/'.$name;
                $arr['featured_image']=$path;
            }
             if($file = $request->file('gallery_image')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('../image', $name);
                $path ='https://kamakhyaits.com/grocery_user/public/image/'.$name;
                $arr['gallery_image']=$path;
            }
            
            Product::find($request->id)->update($arr);
       return response()->json(['status'=>200,'success'=>'user update successfully.']);
 }
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
    
    
    /**
    * Get product detail for order
    */
    public function orderproductDetail($id)
    {
        $product = DB::table('kitsosvw_grocery_product.admin_product')->where('id', $id)->first();

        //header('Content-type: application/json');

        return response()->json($product);
        
    }
}
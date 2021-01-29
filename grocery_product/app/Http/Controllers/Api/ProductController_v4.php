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
class ProductController extends Controller
{
//   public function index(Request $request){
//         $tableIds = DB::table("admin_product_inventary")->where('city_id',$request->city_id)->get();
  
      
//         return response()->json([
//         'inventory' => $tableIds,
//         ]);

// }
    
    public function index(Request $request){
       
         
        $results = DB::select( DB::raw("select api.product_id,api.product_sku,ap.product_name,ap.featured_image,ap.brand_id,ap.description,apc.product_category_name,apc.category_featured_image,
        apsc.product_sub_category_name,api.variant_id,api.variant_sku,apv.minimum_margin,apv.discount_amount variant_discount_amount,api.supplier_id,api.status,api.unit_type,api.unit_amount,
        (CASE 
         WHEN api.discount_type = 'precentage' THEN (api.mrp * (api.discount_amount/100))
         ELSE api.discount_amount
         END) as final_discount,
         api.discount_amount as dis,
        api.mrp,
        api.inventory_id,
        api.discount_type,api.discount_amount inventory_discount_amount from admin_product_inventary api 
       left join admin_product_variant apv on apv.variant_id = api.variant_id 
       left join admin_product ap on ap.product_id = api.product_id 
       left join admin_product_category apc on apc.product_category_id = ap.product_category_id 
       left join admin_product_sub_category apsc on apsc.product_sub_category_id = ap.product_sub_category_id 
       where api.city_id = :city_id and api.availability > 0
    group by api.unit_type, api.unit_amount having Max(final_discount)"), array(
             'city_id' => $request->city_id,
        ));
        
        
        $categories = DB::table('admin_product_category')->select('product_category_name','category_featured_image')->get();
        
        $jsonResult = array();
        $i = -1;
        $previous_p_id = 0;
        foreach($results as $result){
            
            if($previous_p_id != $result->product_id){
                 $previous_p_id = $result->product_id;
                 $i++;
                 $jsonResult[$i]['product_detail'][] = ['product_id'=>$result->product_id,
                'product_sku'=>$result->product_sku,
                'product_name'=>$result->product_name,
                'featured_image'=>$result->featured_image,
                'brand_id'=>$result->brand_id,
                'description'=>$result->description,
                'product_category_name'=>$result->product_category_name,
                'product_sub_category_name'=>$result->product_sub_category_name,
                'category_image'=>$result->category_featured_image,
                ];
                
            }
            
            $jsonResult[$i]['inventory_detail'][] = ['variant_id'=>$result->variant_id,
            'variant_sku'=>$result->variant_sku,
            'minimum_margin'=>$result->minimum_margin,
            'variant_discount_amount'=>$result->variant_discount_amount,
            'supplier_id'=>$result->supplier_id,
            'mrp'=>$result->mrp,
            'inventory_id'=>$result->inventory_id,
            'discount_type'=>$result->discount_type,
            'status'=>$result->status,
            'unit_type'=>$result->unit_type,
            'unit_amount'=>$result->unit_amount,
            'inventory_discount_amount'=>$result->dis,
            'final_discount'=>$result->final_discount,
            
            ];
           
            
        }
         
        return response()->json([
        'category' => $categories,    
        'inventory' => $jsonResult,
        ]);
        
    }
    
    
    
    
    //   public function index(Request $request){
    
      	
    //   	 $tableIds = DB::table("admin_product")
    //             	->join('admin_product_category','admin_product_category.product_category_id','=','admin_product.product_category_id')
    //             	->join('admin_product_sub_category','admin_product_sub_category.product_sub_category_id','=','admin_product.product_sub_category_id')
    //             	->join('brand_table','brand_table.brand_id','=','admin_product.brand_id')
    //             	->select('admin_product.*','admin_product_category.product_category_name','admin_product_sub_category.product_sub_category_name','brand_table.brand_name')
    //             	->get();
    //     $jsonResult = array();

    //     for($i = 0;$i < count($tableIds);$i++)
    //     {
    //          $jsonResult[$i]["product_id"] = $tableIds[$i]->product_id;
    //          $jsonResult[$i]["product_sku"] = $tableIds[$i]->product_sku;
    //          $jsonResult[$i]["product_name"] = $tableIds[$i]->product_name;
    //          $jsonResult[$i]["product_category_name"] = $tableIds[$i]->product_category_name;
    //          $jsonResult[$i]["product_sub_category_name"] = $tableIds[$i]->product_sub_category_name;
    //          $jsonResult[$i]["brand_name"] = $tableIds[$i]->brand_name;
    //          $jsonResult[$i]["featured_image"] = $tableIds[$i]->featured_image;
    //          $jsonResult[$i]["description"] = $tableIds[$i]->description;
    //          $id = $tableIds[$i]->product_sku;
    //           $jsonResult[$i]["variant"] = DB::table("admin_product_variant")
    //           ->join('admin_product_inventary','admin_product_inventary.variant_sku','=','admin_product_variant.variant_sku')
    //           ->where('city_id',$request->city_id)
    //           ->select('admin_product_variant.variant_id','admin_product_variant.variant_sku'
    //           ,'admin_product_inventary.*')
    //           ->get();
            
    //     }

    //     return response()->json([
    //         'product' => $jsonResult,
            
    //     ]);
     
      	 	
    // }
    //  public function index(Request $request){
    // 	$product=DB::table("admin_product_inventary")
    // 	->join('admin_product','admin_product.product_sku','=','admin_product_inventary.product_sku')
    // 	->where('city_id','=',$request->city_id)
    // 	->select('admin_product_inventary.*','admin_product.product_name','admin_product.featured_image','admin_product.gallery_image')
    // 	->get();
    // // 	echo "<pre>";print_r($product);die;
    //   	if(count($product) == 0){
    //   	   	$data['success'] = 201;
    //         $data['message'] = 'inventory not found';
    //         return response()->json(compact('data'));
    //   	}else{
    //   	     $data['success'] = 200;
    //     	$data['message'] = 'list of product';
    //         return response()->json([
    //             'inventory' => $product,
                
    //         ]);
    	
    // 	}
   
    // }
   public function productsearch(Request $request){
   
      $query = $request->product_name;
      $product1 = DB::table('admin_product')
      ->join('admin_product_variant','admin_product_variant.product_sku','=','admin_product.product_sku')
      ->select('admin_product.*','admin_product_variant.product_sku','admin_product_variant.variant_sku','admin_product_variant.unit_type','admin_product_variant.unit_amount')
        ->where('product_name', 'LIKE', "%{$query}%")->orWhere('unit_type', 'LIKE', "%{$query}%")->orWhere('unit_amount', 'LIKE', "%{$query}%")
        ->get();
      if(count($product1) == 0){
    		$data['success'] = 201;
         $data['message'] = 'product not found';
        return response()->json(compact('data'));
    	}
        $data['success'] = 200;
    	$data['message'] = 'list of product';


        return response()->json([
            'product' => $product1,
            
        ]);
 }
 
 
  public function searchinglist(Request $request)
   {
         $p_name = $request->product_name;
         $product1=DB::table("admin_product")
         ->where('product_name','=',$p_name)->get();
        //  echo "<pre>";print_r($product1);die;
          if(count($product1) == 0){
    		$data['success'] = 201;
            $data['message'] = 'product not found';
            return response()->json(compact('data'));
        
    	}else{
          foreach($product1 as $value){
                 $arr['product_sku'] = $value->product_sku; 
             }
             
             $product_sku = $arr['product_sku'];
    // 	echo $product_sku;die;
              $product=DB::table("admin_product_inventary")
             ->join('admin_product','admin_product.product_sku','=','admin_product_inventary.product_sku')
            //  ->join('admin_product_variant','admin_product_variant.product_sku','=','admin_product_inventary.product_sku')
             ->select('admin_product_inventary.*','admin_product.product_name')
             ->where('admin_product_inventary.product_sku','=',$product_sku)->get();
       if(!empty($product)){
    	 $data['success'] = 200;
    	 $data['message'] = 'list of product';
          return response()->json([
            'product' => $product,
            
        ]);
    	}else{
        $data['success'] = 404;
    	$data['message'] = 'list of product';
      return response()->json(compact('data'));
    	}
    	}
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
           
            $checker = Supplierproduct::select('city_id','supplier_id')->where('city_id',$request->city_id)
            ->where('supplier_id',$request->supplier_id)
            ->exists();    
         	if($checker > 0){
         	return response()->json(['status'=>201,'success'=>'sku already exist.']);
         	}
         	else{
         	$cat_id = rand(1000,1000000000);
            $string  = $request->product_name;
            $result = substr($string, 0, 2);
            $str=strtoupper($result);
            $ran = $cat_id.$str;
            $arr['supplier_product_id'] = $ran;
            
            Supplierproduct::create($arr);
             $data = DB::table('supplier_product')->orderBy('id', 'desc')->first();
             
             if(!empty($data)){
                	$cat_id1 = rand(1000,1000000000);
                    $string1  = $request->product_name;
                    $result1 = substr($string1, 0, 2);
                    $str1=strtoupper($result1);
                    $ran1 = $cat_id1.$str1;
                 	$arr['inventory_id'] = $ran1;
                    $arr['availability'] = $request->total_quantity_offered;
				Inventary::create($arr);
				}
			
             return response()->json(['status'=>200,'success'=>'successfully save supplier product.']);
             	 }
            }
            
 }
}
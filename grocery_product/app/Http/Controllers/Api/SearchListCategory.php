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
class SearchListCategory extends Controller
{
public function searchlistcategory(Request $request){
    $cat=$request->product_category_id;
   $results = DB::select( DB::raw("select api.product_id,api.product_sku,ap.product_name,ap.featured_image,ap.brand_id,ap.description,ap.product_category_id,apc.product_category_name,apc.category_featured_image,
        apsc.product_sub_category_name,apsc.product_sub_category_id,api.variant_id,api.variant_sku,api.supplier_id,api.status,api.unit_type,api.unit_amount from admin_product_inventary api
       left join admin_product ap on ap.product_id = api.product_id 
       left join admin_product_category apc on apc.product_category_id = ap.product_category_id 
       left join admin_product_sub_category apsc on apsc.product_sub_category_id = ap.product_sub_category_id 
       where api.city_id = :city_id and ap.product_category_id = :cat_id group by api.product_id
       "), array(
             'city_id' => $request->city_id,
             'cat_id' => $cat
             
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
        'product_category_id'=>$result->product_category_id,
        'product_sub_category_id'=>$result->product_sub_category_id,
        'product_category_name'=>$result->product_category_name,
        'product_sub_category_name'=>$result->product_sub_category_name,
        'category_image'=>$result->category_featured_image,
        ]; 
        $results_inv = DB::select( DB::raw("select api.product_id,api.product_sku,ap.product_name,ap.featured_image,ap.brand_id,apc.product_category_id,ap.description,apc.product_category_name,apc.category_featured_image,
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
        $categories = DB::table('admin_product_sub_category')->where('product_category_id',$request->product_category_id)->get(); 
        if(!empty($categories)){
        return response()->json([
         'status' => '1',
         'message' => 'successfuly found data',
         'category' => $categories,
         'product' => $jsonResultHot,
        ]);
        }else{
          return response()->json([
         'status' => '0',
         'message' => 'data not found',
        ]); 
        }
        
    }
    
   
}
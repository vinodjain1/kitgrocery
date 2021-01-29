<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class SupplierProductController extends Controller
{
 
    public function searchproduct(Request $request)
    {
         $supplier_id = $request->supplier_id;
         $q = $request->q;
         
         $qsarray = explode(' ',$q);
         $search_string = '';
         foreach($qsarray as $qs){
             if($search_string == '')
                $search_string .=  " ap.product_name LIKE '".$q."%' or ap.product_name LIKE '% ".$q."%'";
             else
                $search_string .=  " or ap.product_name LIKE '".$q."%' or ap.product_name LIKE '% ".$q."%'";
         }
          $search_string =  " ap.product_name LIKE '".$q."%'";
          $results = DB::select( DB::raw("select ap.id,ap.product_id,ap.product_sku,ap.product_name,ap.product_category_id,ap.product_sub_category_id,ap.featured_image,ap.gallery_image,ap.brand_id,ap.description,ap.created_at,ap.updated_at,apv.variant_sku,apv.unit_type,apv.unit_amount from admin_product ap 
          left join admin_product_variant apv on apv.product_id = ap.product_id
          left join admin_product_inventary api on api.variant_id = apv.variant_id 
          where ".$search_string." and (api.supplier_id IS NULL || api.supplier_id != '".$supplier_id."')"));
        
        
      
        
        
        $jsonResult = array();
        $i = -1;
        $previous_p_id = 0;
        foreach($results as $result){
            
            
                 
                 $jsonResult[] = [
                'id'=>$result->id,
                'product_id'=>$result->product_id,
                'product_sku'=>$result->product_sku,
                'product_name'=>$result->product_name,
                'product_category_id'=>$result->product_category_id,
                'product_sub_category_id'=>$result->product_sub_category_id,
                'featured_image'=>$result->featured_image,
                'gallery_image'=>$result->gallery_image,
                'brand_id'=>$result->brand_id,
                'description'=>$result->description,
                'created_at'=>$result->created_at,
                'updated_at'=>$result->updated_at,
                'variant_sku'=>$result->variant_sku,
                'unit_type'=>$result->unit_type,
                'unit_amount'=>$result->unit_amount,
                ];
                
            
            
            
           
            
        }
         
        return response()->json([
        'product' => $jsonResult,    
        
        ]);
 
    }

        public function searchproduct1(Request $request)
    {
         $supplier_id = $request->supplier_id;
         $q = $request->q;
         
         $qsarray = explode(' ',$q);
         $search_string = '';
         foreach($qsarray as $qs){
             if($search_string == '')
                $search_string .=  " ap.product_name LIKE '".$q."%' or ap.product_name LIKE '% ".$q."%'";
             else
                $search_string .=  " or ap.product_name LIKE '".$q."%' or ap.product_name LIKE '% ".$q."%'";
         }
          $search_string =  " ap.product_name LIKE '".$q."%'";
          $results = DB::select( DB::raw("select ap.id,ap.product_id,ap.product_sku,ap.product_name,ap.product_category_id,ap.product_sub_category_id,ap.featured_image,ap.gallery_image,ap.brand_id,ap.description,ap.created_at,ap.updated_at,apc.product_category_name,apsc.product_sub_category_name,apv.variant_sku,apv.unit_type,bt.brand_name,apv.unit_amount from admin_product ap 

          left join admin_product_variant apv on apv.product_id = ap.product_id
          left join admin_product_inventary api on api.variant_id = apv.variant_id 
          left join admin_product_category apc on apc.product_category_id = ap.product_category_id 
          left join admin_product_sub_category apsc on apsc.product_sub_category_id = ap.product_sub_category_id 
          left join brand_table bt on bt.brand_id = ap.brand_id 

          where ".$search_string." and (api.supplier_id IS NULL || api.supplier_id != '".$supplier_id."')"));
        
        
      
        
        
        $jsonResult = array();
        $i = -1;
        $previous_p_id = 0;
        foreach($results as $result){
            
            
                 
                 $jsonResult[] = [
                'id'=>$result->id,
                'product_id'=>$result->product_id,
                'product_sku'=>$result->product_sku,
                'product_name'=>$result->product_name,
                'product_category_id'=>$result->product_category_id,
                'product_category_name'=>$result->product_category_name,
                'product_sub_category_id'=>$result->product_sub_category_id,
                'product_sub_category_name'=>$result->product_sub_category_name,
                'featured_image'=>$result->featured_image,
                'gallery_image'=>$result->gallery_image,
                'brand_id'=>$result->brand_id,
                'brand_name'=>$result->brand_name,
                'description'=>$result->description,
                'created_at'=>$result->created_at,
                'updated_at'=>$result->updated_at,
                'variant_sku'=>$result->variant_sku,
                'unit_type'=>$result->unit_type,
                'unit_amount'=>$result->unit_amount,
                
                ];
                
            
            
            
           
            
        }
         
        return response()->json([
        'product' => $jsonResult,    
        
        ]);
 
    }
}
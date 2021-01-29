<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\Shop;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class ShopController extends Controller
{

  public function index(){

    	$product=DB::table('tbl_shop_detail')->orderBy('id','DESC')->get();
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
     $cat_id = rand(1000,1000000000);
            
              $checker1 = Shop::select('reg_number')->where('reg_number',$request->reg_number)->exists();
              $checker = Shop::select('gst_number')->where('gst_number',$request->gst_number)->exists();
             	 if($checker == $request->reg_number){
             	 return response()->json(['status'=>201,'success'=>'shop detail already exist.']);
             	 }else if($checker1 == $request->gst_number){
             	    	 return response()->json(['status'=>202,'success'=>'gst number already exist.']); 
             	 }
             	 
             	 	 else{
             	    $string  = $request->shop_name;
                    $result = substr($string, 0, 2);
                    $str=strtoupper($result);
                    $ran = $str.$cat_id;
                    $arr['shop_id'] = $ran;
                    $arr['pin_code'] = $request->pincode;
             Shop::create($arr);
             $supplier=DB::table('tbl_shop_detail')->select('shop_id','supplier_id')->where('gst_number','=',$request->gst_number)->get();
             foreach($supplier as $value){
                 $arr['shop'] = $value->shop_id;
                 $arr['supplier'] = $value->supplier_id;    
                 
             }
             $shop = $arr['shop'];
             $supplier = $arr['supplier'];
             return response()->json(['status'=>200,'success'=>'shop saved successfully.','supplier'=>$supplier,'shop'=>$shop]);
             	 }
             
 }
 
 public function shopDetail(Request $request)
 {
      
                $shopDetail = Shop::where('supplier_id',$request->supplier_id)->get();
                if($shopDetail){
                return response()->json(['status'=>200,'success'=>'Shop detail successfully.','data' => $shopDetail]);
                }else{
                    return response()->json(['status'=>401,'success'=>'No shop details found.']);
                }
             	 
 }
 
  public function update(Request $request)
 {
       $arr = $request->all();
       if(empty($request->pincode)){
       	$pin=DB::table('tbl_shop_detail')->where('id',$request->id)->get();
       	foreach($pin as $value){
       	    $a = $value->pincode;
       	}
       	// echo "<pre>";print_r($pin);die;
       	$arr['pincode']=$a;
       }else{
           $arr['pincode']=$request->pincode;
       }
       Shop::find($request->id)->update($arr);
       return response()->json(['status'=>200,'success'=>'shop detail update successfully.']);
 }
 public function shop_update_android(Request $request){
     if(!empty($request->supplier_id)){
     $query = Shop::where('supplier_id', $request->supplier_id)
     ->update([
         'shop_name' => $request->shop_name,
         'gst_number' => $request->gst_number,
         'reg_number' => $request->reg_number,
         'week_off' => $request->week_off,
         'address' => $request->address,
         ]);
         
     if($query){
          return response()->json(['status'=>200,'success'=>'shop detail update successfully.']);
     }else{
          return response()->json(['status'=>401,'success'=>'Shop detail not update.']);
     }
     }else{
         return response()->json(['status'=>401,'success'=>'shop id is require.']); 
     }
 }
   public function delete($id)
    {
        $delete = Shop::where('id', $id)->delete();

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
    public function particularshopdetail(Request $request){
        $shop_id = $request->supplier_id;
        $query = DB::table('tbl_shop_detail')->join('suppliers','suppliers.supplier_id','=','tbl_shop_detail.supplier_id')
        ->select('tbl_shop_detail.*','suppliers.name','suppliers.phone','suppliers.email')->where('tbl_shop_detail.supplier_id',$shop_id)->get();
        // echo "<pre>";print_r($query);die;
       if($query == null){
    		$data['success'] = 200;
            $data['message'] = 'product not found';
            return response()->json(compact('data'));
    	}
    	$data['success'] = 200;
    	$data['message'] = 'list of product';
        return response()->json($query);
    }
 
}
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

    	$product=DB::table('tbl_shop_detail')->get();
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

            
              $checker1 = Shop::select('reg_number')->where('reg_number',$request->reg_number)->exists();
              $checker = Shop::select('gst_number')->where('gst_number',$request->gst_number)->exists();
             	 if($checker == $request->reg_number){
             	 return response()->json(['status'=>201,'success'=>'registration number already exist.']);
             	 }else if($checker1 == $request->gst_number){
             	    	 return response()->json(['status'=>202,'success'=>'gst number already exist.']); 
             	 }
             	 
             	 	 else{
             	    $string  = $request->shop_name;
                    $result = substr($string, 0, 2);
                    $str=strtoupper($result);
                    $ran = $str.$request->shop_id;
                    $arr['shop_id'] = $ran;
             Shop::create($arr);
             $supplier=DB::table('tbl_shop_detail')->select('shop_id','supplier_id')->where('gst_number','=',$request->gst_number)->get();
             foreach($supplier as $value){
                 $arr['shop'] = $value->shop_id;
                 $arr['supplier'] = $value->supplier_id;    
                 
             }
             $shop = $arr['shop'];
             $supplier = $arr['supplier'];
             return response()->json(['status'=>200,'success'=>'supplier saved successfully.','supplier'=>$supplier,'shop'=>$shop]);
             	 }
             
 }
  public function update(Request $request)
 {
       $arr = $request->all();
       Shop::find($request->id)->update($arr);
       return response()->json(['status'=>200,'success'=>'shop detail update successfully.']);
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
  
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Payment;
use App\Order_item;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Guzzle\Http\Client;
use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class PaymentController extends Controller
{
public function index(Request $request)
    {
        $product =DB::table('user_order_item')->where('order_status','request')->get();
         if($product == null){
    		$data['success'] = 200;
         $data['message'] = 'product not found';
        return response()->json(compact('data'));
    	}else{
    	
    	$data['success'] = 200;
    	$data['message'] = 'list of product';

        
        return response()->json($product);
   
    }
  
}
 public function request(Request $request)
    {
       $arr = $request->all();
       $postvalue = unserialize(base64_decode( $request->partial_order_id));
      foreach($postvalue as $value){
      $data =Order_item::where('partial_order_id', $value)->update(['order_status' => 'request']);
      }
      return response()->json(['status'=>200,'success'=>'payment request successfully add.']);
             	
    }

}
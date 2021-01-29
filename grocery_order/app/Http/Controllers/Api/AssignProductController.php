<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Guzzle\Http\Client;
use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class AssignProductController extends Controller
{
public function assign(Request $request)
    {
     $order = DB::select("select * from user_order_item where pin_code='$request->pin_code' AND internal_order_status='complete'");
     foreach($order as $val){
         $pin = $val->pin_code;
         $supplier_id = $val->supplier_id;
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://kamakhyaits.com/grocery_product/public/Api/pin_code?pin_code='.$pin);
        $response = $request->getBody();
        $data = json_decode($response);
        foreach($data as $value){
            
             
             $shop = new \GuzzleHttp\Client();
             $requests = $shop->get('https://kamakhyaits.com/grocery_user/public/shop_data?supplier_id='.$supplier_id);
             $responses = $requests->getBody();
             $shop_data = json_decode($responses);
            if($value->pin_code == $val->pin_code){
                $arr = array(
                    "zone_name" => $value->zone_name,
                     "pin_code" => $value->pin_code,
                    "pincode_data" => $order,
                    "shop_detail"=>$shop_data,
                    );
                
            }
        }
     }
     if($arr > 0){
        return response()->json(['status'=>200,'message'=>'successfully place order.','data'=>$arr]);
     }
      else{
        return response()->json(['status'=>401,'error'=>'your order not place.']);
      }
  
}

}
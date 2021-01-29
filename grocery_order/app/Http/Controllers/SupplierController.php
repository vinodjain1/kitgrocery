<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Payment;
use App\Order_item;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Guzzle\Http\Client;
use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class SupplierController extends Controller
{
public function index(){
$product=DB::table("user_order_item")
->join('user_order_table','user_order_table.order_id','=','user_order_item.order_id')
->select('user_order_item.*','user_order_table.order_date','user_order_table.pin_code')->where('user_order_item.internal_order_status','=','uncomplete')->orderBy('user_order_item.id','DESC')
->get();
// echo "<pre>";print_r($product);die;
	if($product == null){
		$data['success'] = 200;
     $data['message'] = 'Order items';
    return response()->json(compact('data'));
	}
	
	$data['success'] = 200;
	$data['message'] = 'list of category';

    
    return response()->json($product);

}
 public function updatestatus(Request $request)
    {
       $st = $request->country_id;   
        $status = substr($st, strpos($st, " ") + 1); 
       
        $needle    = ' ';
        $id = strstr($st, $needle, true);
        // echo $id;die;
       $sub_str= substr(strstr($st," "), 1);
      $data['states'] = Order_item::where('id', $id)->update(['customer_order_status' => $sub_str]);
        
        return response()->json($data);
    }
   public function orderupdatestatusinternal(Request $request)
    {
       $st = $request->country_id;   
        $status = substr($st, strpos($st, " ") + 1); 
       
        $needle    = ' ';
        $id = strstr($st, $needle, true);
        // echo $id;die;
       $sub_str= substr(strstr($st," "), 1);
      $data['states'] = Order_item::where('id', $id)->update(['internal_order_status' => $sub_str]);
        
        return response()->json($data);
    }  
    public function test(Request $request)
    {
    	$url = 'https://kamakhyaits.com/grocery_order/public/Api/add-to-cart';
	  	 $ch = curl_init($url);
		 $data1=json_encode($request->data);
         $data = '{
            "status": 1,
            "success": "successfully add to cart.",
            "data": '.$data1.'					
         }';
		 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  $result = curl_exec($ch);
		  curl_close($ch);
		  print_r($result);
		  exit();
		  $data = json_decode(file_get_contents('php://input'), true);
    }

        


}
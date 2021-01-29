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
class SupplierCompleteOrderController extends Controller
{
public function list(Request $request)
    {
        // echo "hello";
        $dat = date("Y-m-d", strtotime("-2 day"));
        // echo $dat.' 00:00:00';die;
        $data =DB::select("SELECT * FROM `user_order_item` WHERE `supplier_id`='$request->supplier_id' AND `internal_order_status`='complete' AND `order_date` <= '$dat'");
     if($data != null){
        return response()->json(['status'=>200,'message'=>'complete order list.','data'=> $data]);
     }
      else{
        return response()->json(['status'=>401,'error'=>'order not found.']);
      }
  
}
public function complete_order_list(Request $request)
    {
        // echo "hello";
        $dat = date("Y-m-d", strtotime("-2 day"));
        // echo $dat.' 00:00:00';die;
        $product =DB::select("SELECT * FROM `user_order_item` WHERE `internal_order_status`='complete' AND `order_date` <= '$dat'");
        if($product == null){
    		$data['success'] = 200;
         $data['message'] = 'complete order list';
        return response()->json(compact('data'));
    	}else{
    	$data['success'] = 200;
    	$data['message'] = 'order not found';

        
        return response()->json($product);
   
    }
  
}



public function todaySale(Request $request)
{
        // echo "hello";
        $dat = date("Y-m-d");
        
      
        // echo $dat.' 00:00:00';die;
        //$data =DB::select("SELECT * FROM `user_order_item` WHERE `supplier_id`='$request->supplier_id' AND `internal_order_status`='complete' AND `order_date` = '$dat'");
            $data = Order_item::where('supplier_id',$request->supplier_id)->where('internal_order_status','=','complete')->where('order_date',$dat)->sum('selling_price');
            $dataCount = Order_item::where('supplier_id',$request->supplier_id)->where('internal_order_status','=','complete')->where('order_date',$dat)->get();
            
            //dd(count($dataCount));
            $count = count($dataCount);
            //dd($data);
     if($data != null){
        return response()->json(['status'=>200,'message'=>'Today order sale.','count'=>$count,'data'=> $data]);
     }
      else{
        return response()->json(['status'=>200,'message'=>'Today no order sale.','count'=>0,'data'=> 0]);
      }
  
}

    public function orderList(Request $request)
    {
            // echo "hello";
            $dat = date("Y-m-d");
            
            
            // echo $dat.' 00:00:00';die;
            //$data =DB::select("SELECT * FROM `user_order_item` WHERE `supplier_id`='$request->supplier_id' AND `internal_order_status`='complete' AND `order_date` = '$dat'");
                $data = Order_item::where('supplier_id',$request->supplier_id)->where('order_date',$request->date)->get();
                //dd($data);
         if($data != null){
            return response()->json(['status'=>200,'message'=>'Order List Succesfully.','data'=> $data]);
         }
          else{
            return response()->json(['status'=>401,'error'=>'Order Not Found.']);
          }
      
    }
    
    
    /*
     *
     * supplier order detail
     */

    public function orderdetail(Request $request)
    {

        //$get_product_detail = $this->get_curl_data('http://localhost/kamakhyaits.com/grocery_product/public/api/products/detail/3');

        //header('Content-type: application/json');
        //$get_product_detail = json_decode($get_product_detail);
        //print_r($get_product_detail->id);
        //exit();

        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:user_order_item,order_id',
            'supplier_id' => 'required',
            //'status' => 'required|boolean',
        ],[
            'order_id.required' => 'The :attribute field is required.',
            'order_id.exists' => 'The :attribute field is invalid.',
            'supplier_id.required' => 'The :attribute field is required.',
        ]);

        if ($validator->fails()) {

            return response()->json(['status' => 202, 'success' => $validator->errors()->first()]);
        }


        $orderitems = Order_item::where('supplier_id', $request->supplier_id)->where('order_id', $request->order_id)->get();

        $array = [];
        $payment_array = [];

        if(count($orderitems)) {

             foreach($orderitems as $key => $order)
            {
                $array[$key]['product_name'] = $order->product_name ? : '';
                $array[$key]['amount'] = $order->supplier_amount ? : '';
                $array[$key]['quantity'] = $order->unit_amount.' '.$order->unit_type;
                $array[$key]['product_sku'] = $order->product_sku ? : '';
                $array[$key]['item'] = $order->quantity ? : '';

                $get_product_detail = $this->get_curl_data('https://kamakhyaits.com/grocery_product/public/api/products/detail/'.$order->product_id);

                $array[$key]['product_image'] = isset($get_product_detail->featured_image) ? $get_product_detail->featured_image : '';

            }
            
            $total_product_items = 0;
            $sub_total = 0;
            
            foreach($orderitems as $key => $order)
            {
                //if($order->unit_type=='gm') {
                  $sub_total += $order->supplier_amount*$order->quantity;
                //}
                /*else{
                  $sub_total += $order->supplier_amount*$order->quantity;
                }*/
                $total_product_items +=$order->quantity;

                $payment_array[$key]['product_name'] = $order->product_name ? : '';
                $payment_array[$key]['unit'] = $order->unit_amount.' '.$order->unit_type;
                //$payment_array[$key]['quantity'] = $total_product_items +=$order->quantity ? : '';
                $payment_array[$key]['quantity'] = $order->quantity ? : '';
                $payment_array[$key]['price'] = $order->supplier_amount ? : '';
            }
            
            
            $get_order_detail = DB::table('user_order_table')->where('order_id', $request->order_id)->first();
            if($get_order_detail) {
              //Get user detail
              $get_user_detail = $this->get_curl_data('https://kamakhyaits.com/grocery_user/public/api/users/detail/'.$get_order_detail->user_id);

              $first_name = isset($get_user_detail->name) ? $get_user_detail->name : '';
              $last_name = isset($get_user_detail->last_name) ? $get_user_detail->last_name : '';

              $user_name = $first_name.' '.$last_name;

            }else{
              $user_name = '';
            }

            $response = [
                'status' => 200,
                'message' => 'Order detail.',
                'CurrentProductStatus ' => $order->internal_order_status,
                'user_name' => $user_name,
                'order_id' => $request->order_id,
                'order_date' => $order->order_date,
                'total_item' => $total_product_items,
                'sub_total' => $sub_total,
                'data' => $array,
                'payment_details' => $payment_array,
            ];

            return response()->json($response);

        }else {

           return response()->json(['status' => 404, 'message' => 'Order detail not found.', 'data' => '']);
        }

    }


    public function get_curl_data($url)
    {

      $crl = curl_init();

      curl_setopt($crl, CURLOPT_URL, $url);
      curl_setopt($crl, CURLOPT_FRESH_CONNECT, true);
      curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($crl);
      curl_close($crl);

      return json_decode($response);
    }
}
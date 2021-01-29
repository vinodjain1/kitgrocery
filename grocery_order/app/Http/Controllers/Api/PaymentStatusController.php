<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\paymentstatus;
use App\AddLog;
use App\Order_item;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Guzzle\Http\Client;
use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class PaymentStatusController extends Controller
{
public function store(Request $request)
    {
        $dat = date('Y-m-d');
        // echo $request->order_id;die;
        $data = paymentstatus::where('order_id', $request->order_id)
       ->update([
           'payment_date' => $dat,
           'status' => 'complete',
           'payment_id' => $request->payment_id,
        ]);
        // echo $data;die;
     if($data > 0){
         $query = Order_item::where('order_id', $request->order_id)
       ->update([
           'internal_order_status' => 'complete',
        ]);
        if($query > 0){
        $delete = AddLog::where('user_id', $request->user_id)->delete();
        return response()->json(['status'=>200,'message'=>'successfully place order.']);
        }
     }
      else{
        return response()->json(['status'=>401,'error'=>'your order not place.']);
      }
  
}

}
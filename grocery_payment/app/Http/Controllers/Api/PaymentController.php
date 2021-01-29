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
        $completePayment=Payment::where('supplier_id',$request->supplier_id)->where('status','complete')->whereYear('created_at',$request->year)->get();
        $orderId=Payment::where('supplier_id',$request->supplier_id)->where('status',null)->get();
        $walletAmount=Order_item::where('supplier_id',$request->supplier_id)->whereIn('order_id',$orderId->order_id)->where('order_status','complete')->sum('supplier_amount');
        
        $requestAmount=Payment::where('supplier_id',$request->supplier_id)->where('status','request')->get();
        $data = [
            'complete_amount' => $completePayment,
            'wallet_amount' => $walletAmount,
            'request_amount' => $requestAmount
            ];
    	if($data !== null){
            return response()->json(['status'=>200,'success'=>'Wallet payments list successfully.','data'=>$data]);
    	}else{
            return response()->json(['status'=>401,'message'=>'payment list not found']);
    	}
    
    }
// public function store(Request $request)
//     {
//         $arr = $request->all();
//         $arr['status']='painding';
//         $data =Payment::create( $arr)->id;
//      if($data > 0){
//         return response()->json(['status'=>200,'message'=>'successfully payment.']);
//      }
//       else{
//         return response()->json(['status'=>401,'error'=>'payment faild.']);
//       }
  
// }
public function request(Request $request)
{
   $arr = $request->all();
   $arr['order_id']=$request->partial_order_id;
   $arr['total_amount']=$request->supplier_amount;
   $arr['status']='request';
  $data =Payment::create( $arr)->id;
     return response()->json(['status'=>200,'success'=>'payment request successfully add.']);
         	
}

}
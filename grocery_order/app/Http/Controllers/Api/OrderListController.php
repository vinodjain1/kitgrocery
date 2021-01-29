<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Guzzle\Http\Client;
use Illuminate\Support\Facades\Validator;
use App\Order_item;
use App\Order;

header('Access-Control-Allow-Origin:*');

class OrderListController extends Controller
{

    public function list(Request $request)
    {
        $query = DB::table('user_order_table')->join('user_order_item','user_order_item.order_id','=','user_order_table.order_id')->select('user_order_item.order_id','user_order_item.supplier_id','user_order_item.inventory_id','user_order_item.product_name','user_order_item.unit_type','user_order_item.unit_amount','user_order_item.selling_price','user_order_table.user_id','user_order_table.status','user_order_item.created_at')->where('user_order_table.user_id',$request->user_id)->orWhere('status','complete')->get();
        
        if($query != null) {
            return response()->json(['status'=>200,'message'=>'data was found.','data'=>$query]);
        }else{
            return response()->json(['status'=>401,'message'=>'data not found.']);
        }
    
    }

    
    /**
     * Get the pending order list
     *
     */
    public function orderlistPending(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'driver_id' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json(['status' => 202, 'success' => 'Driver id field required.']);
        }

        $driver_id = $request->driver_id;

        //$orders = Order_item::where('driver_id', $driver_id)->where('order_status', 'dispatched')->get();
        //$orders = Order_item::where('order_status', 'dispatched')->where('order_accepted_status', false)->get();
        $orders = Order_item::where('order_status', 'dispatched')->get();
        //$orders = Order_item::where('order_status', 'dispatched')->whereNull('driver_id')->orWhere('driver_id', $driver_id)->get();
        //echo $orders;
        //exit();
        $array = [];
        $order_status = 202;
        $message = 'Order not found.';

        if(count($orders)) {$order_status = 200; $message = 'Order list.';}

        foreach($orders as $key => $order)
        {
            $array[$key]['order_item_id'] = $order->id ? : '';
            $array[$key]['order_id'] = $order->order_id ? : '';
            $array[$key]['partial_order_id'] = $order->partial_order_id ? : '';
            $array[$key]['address'] = $order->address ? : '';
            $array[$key]['status'] = $order->order_status ? : '';
            $array[$key]['order_accepted_status'] = $order->order_accepted_status ? 'active' : "pending";
            /*$array[$key]['product_sku'] = $order->product_sku ? : '';
            $array[$key]['supplier_id'] = $order->supplier_id ? : '';
            $array[$key]['inventory_id'] = $order->inventory_id ? : '';
            $array[$key]['inventory_id'] = $order->driver_id ? : '';
            $array[$key]['hub_id'] = $order->hub_id ? : '';
            $array[$key]['customer_order_status'] = $order->customer_order_status ? : '';
            $array[$key]['internal_order_status'] = $order->internal_order_status ? : '';
            $array[$key]['product_name'] = $order->product_name ? : '';
            $array[$key]['unit_type'] = $order->unit_type ? : '';
            $array[$key]['unit_amount'] = $order->unit_amount ? : '';
            $array[$key]['quantity'] = $order->quantity ? : '';
            $array[$key]['selling_price'] = $order->selling_price ? : '';
            $array[$key]['supplier_amount'] = $order->supplier_amount ? : '';
            $array[$key]['city'] = $order->city ? : '';
            $array[$key]['pin_code'] = $order->pin_code ? : '';
            $array[$key]['order_date'] = $order->order_date ? : '';*/
        }

        $response = [
            'status' => $order_status,
            'message' => $message,
            'data' => $array,
        ];

        return response()->json($response);

    }
    
    /**
     * Order accept by driver
     *
     */
    public function orderaccept(Request $request)
    {
        $messages = [
            'status.boolean' => 'The :attribute field is required.',
        ];

        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:user_order_item,partial_order_id',
            'driver_id' => 'required',
            //'status' => 'required|boolean',
        ],[
            'order_id.required' => 'The :attribute field is required.',
            'order_id.exists' => 'The :attribute field is invalid.',
            'status.boolean' => 'The :attribute field is boolean.',
            'driver_id.required' => 'The :attribute field is required.',
            'status.required' => 'The :attribute field is required.',
        ]);

        if ($validator->fails()) {
            if($validator->errors()->first('driver_id')) {
                $msg = 'Driver id field required';
            }else{
               $msg = $validator->errors()->first('status'); //'Order accpet status field required';
            }
            return response()->json(['status' => 202, 'success' => $validator->errors()->first()]);
        }

        $driver_id = $request->driver_id;
        $order_id = $request->order_id;
        $status = $request->status;
        //->where('driver_id', $driver_id)
        $order = Order_item::where('partial_order_id', $order_id)->first();
        $order->driver_id = $driver_id;
        $order->order_accepted_status = true;
        $order->update();
        if($order) {
            $order_status_type = 200;
            $message = 'Order accpet successfully.';
        }else {
            $message = 'Oops! Something went wrong.';
        }

        $response = [
            'status' => 200,
            'message' => $message,
        ];

        return response()->json($response);

    }
    
    public function driverorderDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'driver_id' => 'required',
            'partial_order_id' => 'required|exists:user_order_item,partial_order_id',
        ],[
            'driver_id.required' => 'The :attribute field is required.',
            'partial_order_id.required' => 'The :attribute field is required.',
            'partial_order_id.exists' => 'The :attribute field is invalid.',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'error' => $validator->errors()->first()]);
        }

        $driver_id = $request->driver_id;
        $partial_order_id = $request->partial_order_id;

        $order_item_detail = Order_item::where('driver_id', $driver_id)->where('partial_order_id', $partial_order_id)->first();

        if($order_item_detail) {

            $order_detail = Order::where('order_id', $order_item_detail->order_id)->first();

            $array['picakup_address'] = $order_item_detail->address ? : '';
            $array['delivery_address'] = $order_detail->address ? : '';
            $array['pickup_details'] = [
                'product_name' => $order_item_detail->product_name,
                'unit' => $order_item_detail->unit_amount.' '.$order_item_detail->unit_type,
                'quantity' => $order_item_detail->quantity,
            ];
            
            $array['order_date'] = $order_detail->order_date;
            $array['order_accepted_status'] = $order_item_detail->order_accepted_status ? 'order Accepted' : "not Accepted";
            
            //Get supplier contact detail.
            $supplier_detail = DB::connection('mysql2')->select("SELECT * FROM `suppliers` WHERE `supplier_id` =  '".$order_item_detail->supplier_id."'");

            $array['contact_detail'] = $supplier_detail[0]->phone ? : '';
            
            $response = [
                'status' => 200,
                'message' => 'Order detail',
                'data' => $array,
            ];

            return response()->json($response);
        }

        $response = [
            'status' => 404,
            'message' => 'Order detail not found',
            'data' => [],
        ];

        return response()->json($response);
    }
    
    public function orderstatusupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'driver_id' => 'required',
            'partial_order_id' => 'required|exists:user_order_item,partial_order_id',
            'internal_order_status' => 'required',
            'customer_order_status' => 'required',
        ],[
            'driver_id.required' => 'The :attribute field is required.',
            'partial_order_id.required' => 'The :attribute field is required.',
            'partial_order_id.exists' => 'The :attribute field is invalid.',
            'internal_order_status.required' => 'The :attribute field is required.',
            'customer_order_status.required' => 'The :attribute field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'error' => $validator->errors()->first()]);
        }

        $driver_id = $request->driver_id;
        $partial_order_id = $request->partial_order_id;
        $internal_order_status = $request->internal_order_status;
        $customer_order_status = $request->customer_order_status;

        $order_item_detail = Order_item::where('driver_id', $driver_id)->where('partial_order_id', $partial_order_id)->first();

        if($order_item_detail) {

            $order_item_detail->internal_order_status = $internal_order_status;
            $order_item_detail->customer_order_status = $customer_order_status;
            $order_item_detail->order_status = $internal_order_status;
            $order_item_detail->update();

            $response = [
                'status' => 200,
                'message' => 'Status Updated Successfully',
                //'data' => [],
            ];

            return response()->json($response);
        }

        $response = [
            'status' => 404,
            'message' => 'Order detail not found',
            'data' => [],
        ];

        return response()->json($response);
    }
    
    /**
     * Get the complete order list
     *
     */
    public function orderlistCompleted(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'driver_id' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json(['status' => 202, 'success' => 'Driver id field required.']);
        }

        $driver_id = $request->driver_id;

        //$orders = Order_item::where('driver_id', $driver_id)->orWhere('internal_order_status', 'Completed')->orWhere('internal_order_status', 'Delivered')->get();
        $orders = Order_item::where('driver_id', $driver_id)->where('internal_order_status', 'Completed')->get();

        $array = [];
        $order_status_type = 202;
        $message = 'Order not found.';

        if(count($orders)) {$order_status_type = 200; $message = 'Order list.';}

        foreach($orders as $key => $order)
        {
            $array[$key]['order_item_id'] = $order->id ? : '';
            $array[$key]['order_id'] = $order->order_id ? : '';
            $array[$key]['partial_order_id'] = $order->partial_order_id ? : '';
            $array[$key]['address'] = $order->address ? : '';
            $array[$key]['status'] = $order->internal_order_status ? : ''; //$order->order_status ? : '';
            $array[$key]['order_accepted_status'] = $order->order_accepted_status ? 'active' : "pending";
        }

        $response = [
            'status' => $order_status_type,
            'message' => $message,
            'data' => $array,
        ];

        return response()->json($response);

    }
    
    public function walletamount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json(['status' => 202, 'success' => 'supplier id field required.']);
        }

        $supplier_id = $request->supplier_id;

        $supplier_amount = Order_item::where('supplier_id', $supplier_id)->where('internal_order_status', 'Completed')->where('wallet_amount_status', false)->whereDate('created_at', '<=', \Carbon\Carbon::today()->subDays(2))->sum('supplier_amount');

        
        //return \Carbon\Carbon::now()->subDays(2);
        //$date = \Carbon\Carbon::today()->subDays(30);

        $response = [
            'status' => 200,
            'message' => 'Wallet amount',
            'amount' => number_format($supplier_amount, 2),
        ];

        return response()->json($response);

    }
    
    public function transactionRequesttoAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json(['status' => 202, 'success' => 'supplier id field required.']);
        }

        $supplier_id = $request->supplier_id;

        $orderitems = Order_item::where('supplier_id', $supplier_id)->where('internal_order_status', 'Completed')->whereDate('created_at', '<=', \Carbon\Carbon::today()->subDays(2))->get();
        
        $supplier_amount = Order_item::where('supplier_id', $supplier_id)->where('internal_order_status', 'Completed')->where('wallet_amount_status', false)->whereDate('created_at', '<=', \Carbon\Carbon::today()->subDays(2))->sum('supplier_amount');

        
        if($supplier_amount>0){
            
            $user_order_item_id = '';
            $partial_order_id = '';
            $order_id = '';

            foreach ($orderitems as $orderitem) {
            
                $update_wallet_amount_satus = Order_item::where('id', $orderitem->id)->first();
                $update_wallet_amount_satus->wallet_amount_status = true;
                $update_wallet_amount_satus->update();
            }
            
            $create_request = DB::table('user_tranaction_request')->insert([
                'user_order_item_id' => $user_order_item_id,
                'partial_order_id' => $partial_order_id,
                'order_id' => $order_id,
                'supplier_id' => $supplier_id,
                'request_amount' => $supplier_amount,
                'status' => 'Processing',
            ]);

            $response = [
                'status' => 200,
                'message' => 'Requested Money.',
                'amount' => number_format($supplier_amount, 2),
            ];

            return response()->json($response);
        }


        $response = [
                'status' => 202,
                'message' => 'Wallet amount not found. please try again',
                'amount' => number_format($supplier_amount, 2),
            ];

            return response()->json($response);

    }

    public function transactionRequestlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required',
            'month' => 'required',
            'year' => 'required',
        ],[
            'supplier_id.required' => 'The :attribute field is required.',
            'month.required' => 'The :attribute field is required.',
            'year.required' => 'The :attribute field is required.'
        ]);

        if ($validator->fails()) {

            return response()->json(['status' => 442, 'error' => $validator->errors()->first()]);
        }

        $supplier_id = $request->supplier_id;


        $transactionRequestlist = DB::table('user_tranaction_request')
                                    ->whereMonth('created_at', $request->month)
                                    ->whereYear('created_at', $request->year)
                                    ->where('supplier_id', $supplier_id)
                                    ->get();


        $array = [];

        $status = 202;
        
        $message = 'Data not found.';

        if(count($transactionRequestlist)) {$status = 200; $message = 'Request transaction list.';}

        foreach ($transactionRequestlist as $key => $row_request) {
            $user_order = Order::where('order_id', $row_request->order_id)->first(['user_id']);
            
            $user_id = '';
            if($user_order) {
                $user_id = $user_order->user_id;
            }
            //Get user contact detail.
            $user_detail = DB::connection('mysql2')->select("SELECT * FROM `users` WHERE `user_id` =  '".$user_id."'");
            
            if($user_detail) {
            $array[$key]['user_name'] = $user_detail[0]->name ? : '';
            }else{
            $array[$key]['user_name'] = '';    
            }
            $array[$key]['request_amount'] = number_format($row_request->request_amount, 2);
            $array[$key]['status'] = $row_request->status ? : '';
            $array[$key]['date'] = \Carbon\Carbon::parse($row_request->created_at)->format('d M Y');
        }

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $array,
        ];

        return response()->json($response);


    }
 
}
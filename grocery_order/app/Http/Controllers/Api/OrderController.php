<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Payment;
use App\Order;
use App\Order_item;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Guzzle\Http\Client;
use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class OrderController extends Controller
{
public function store(Request $request)
    {
        $inventory_arr=[];
    $arr= $request->all();
    $cat_id = rand(1000,1000000000);
    $string  = $request->address;
    $inventory_arr = json_encode($request->inventory);
//  echo "<pre>";print_r($inventory_arr);die;
    $result = substr($string, 0, 2);
    $str=strtoupper($result);
    $ran = $str.$cat_id;
    $arr['order_id'] = $ran;
    $arr['order_date'] = date('Y-m-d');
    $arr['order_time'] = date("H:i:s");
    $user_id = $request->user_id;
    $id = Order::create( $arr)->order_id;
    //if($id > 0){
    if($id){    

    foreach(json_decode($inventory_arr) as $val){
        // echo $val->inventory_id;die;
        $cat_id = rand(1000,1000000000);
        $string  = $request->user_id;
        $result = substr($string, 0, 2);
        $str=strtoupper($result);
        $ran1 = $str.$cat_id;
        $mrp= $val->mrp;
        $discount_type = isset($val->discount_type) ? $val->discount_type : '';
        $discount_amount = isset($val->discount_amount) ? $val->discount_amount : 0;
        if($discount_type == 'flat price'){
        $arr1['supplier_amount'] = $mrp-$discount_amount;
        }else{
           $val1 = ($discount_amount/100)*$mrp;
           $arr1['supplier_amount']=$mrp-$val1;
        }
        
        $arr1['partial_order_id']=$ran1;
        $arr1['product_sku'] = $val->product_sku; 
        $arr1['inventory_id'] = $val->inventory_id; 
        $arr1['supplier_id'] = $val->supplier_id;
        $arr1['product_name']=$val->product_name;
        $arr1['unit_type']=$val->unit_type;
        $arr1['unit_amount']=$val->unit_amount;
        $arr1['quantity']= $val->quantity;
        $arr1['selling_price'] = $val->price;
        $arr1['city'] = isset($request->city_id) ? $request->city_id : NULL;
        $arr1['pin_code'] = $request->pin_code ?  : NULL;
        $arr1['address'] = $request->address;
        $arr1['customer_order_status'] = 'new order';
        $arr1['order_id'] = $ran;
      
        $arr1['order_date'] = date('Y-m-d');
        Order_item::create($arr1);
        
         /*Payment::create([
           'order_id' => $ran,
           'supplier_id' => $val->supplier_id,
           'user_id' => $user_id
           
            ]);*/
        
      }
     
        return response()->json(['status'=>200,'message'=>'successfully place order.','data'=>$id]);
 }
      else{
        return response()->json(['status'=>401,'message'=>'your order not place.']);
      }
  
}
 public function update(Request $request)
 {
      $arr = $request->all();
              $validator = Validator::make($request->all(), [
                    'product_name' => 'required',
                ]);
               if ($validator->fails()) {
                return response()->json(['status'=>202,'success'=>'category name required.']);
            }else{

       if($file = $request->file('featured_image')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('../image', $name);
                $path ='https://kamakhyaits.com/grocery_user/public/image/'.$name;
                $arr['featured_image']=$path;
            }
             if($file = $request->file('gallery_image')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('../image', $name);
                $path ='https://kamakhyaits.com/grocery_user/public/image/'.$name;
                $arr['gallery_image']=$path;
            }
            
            Product::find($request->id)->update($arr);
       return response()->json(['status'=>200,'success'=>'user update successfully.']);
 }
 } 
     public function delete($id)
    {
        $delete = Product::where('id', $id)->delete();

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
    
public function changeStatus(Request $request)
{
                     
     $supplier_id = $request->supplier_id;
     $partial_order_id = $request->partial_order_id;
     $internal_order_status = $request->internal_order_status;
     $customer_order_status = $request->customer_order_status;
     
     $update_order_status = Order_item::where('partial_order_id', $partial_order_id)->first();
     if($update_order_status) {
        
      $update_order_status->internal_order_status = $internal_order_status;
      $update_order_status->customer_order_status = $customer_order_status;
      $update_order_status->order_status = $internal_order_status;
      $update_order_status->update();
        
        return response()->json(['status'=>200,'success'=>'order status updated successfully.']);
        
     }else{
         
         return response()->json(['status'=>401,'success'=>'order not found.']);
         
     }
     
     
     
    /*$result1 = Order_item::where('partial_order_id', $partial_order_id)->update([
        'internal_order_status'=>$internal_order_status,
        'customer_order_status' => $customer_order_status
        ]);
    if($result1){
        return response()->json(['status'=>200,'success'=>'order status updated successfully.']);
    }else{
        return response()->json(['status'=>401,'success'=>'order not found.']);
    }*/
 
 }
}
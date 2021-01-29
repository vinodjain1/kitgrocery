<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\AddCart;
use App\AddLog;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class AddCartController extends Controller
{
   
     public function index(Request $request){
           if(!empty($request->user_id && $request->device_id)){
            //   echo "hello";die;
               $product=DB::table("user_cart_log")
               ->select('user_cart_log.*')
               ->where('user_id','=',$request->user_id)->orWhere('device_id','=',$request->device_id)->get();
               if(count($product) == 0){
                $data['success'] = 404;
                $data['message'] = 'product not found';
                return response()->json(compact('data'));
               }else{
                   	$data['success'] = 200;
                	$data['message'] = 'list of prouct';
                    return response()->json([
                            'product' => $product,
                        ]);
               }
           } if(!empty($request->device_id)){
               
                $product=DB::table("user_cart_management")->where('device_id','=',$request->device_id)->get();
               if(count($product) == 0){
                $data['success'] = 404;
                $data['message'] = 'product not found';
                return response()->json(compact('data'));
               }else{
                   	$data['success'] = 200;
                	$data['message'] = 'list of product';
                    return response()->json([
                            'product' => $product,
                        ]);
               }
           }else{
                $data['success'] = 404;
                $data['message'] = 'product not found';
                return response()->json(compact('data'));
           }
            
   
    }
 

  public function store1(Request $request)
 {
    
        $arr = $request->all();
        $cat_id = rand(1000,1000000000);
       
        
            $inventory_arr=[];
            $inventory_arr = json_encode($request->data);
            foreach(json_decode($inventory_arr) as $value){
                    $arr['cart_id'] = $cat_id;
                    $arr['user_id'] = $value->user_id;
                    $arr['device_id'] = $value->device_id;
                    $arr['inventory_id'] = $value->inventory_id;
                    $arr['location'] = $value->location;
                    $arr['price'] = $value->price;
                    $arr['date'] = $value->date;
                    $arr['quantity'] = $value->quantity;
                    $arr['product_image']=$value->product_image;
                     AddLog::create($arr);
      }
     
        return response()->json(['status'=>200,'error'=>'successfully place order.']);
       
        }

 
     public function store(Request $request)
 {
    
        $arr = $request->all();
        if($file = $request->file('product_image')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('../image', $name);
                $path ='https://kamakhyaits.com/grocery_order/public/image/'.$name;
                $arr['product_image']=$path;
            }
        
        
        
        $cat_id = rand(1000,1000000000);
        $string  = $request->location;
        $result = substr($string, 0, 2);
        $str=strtoupper($result);
        $ran = $str.$cat_id;
        $arr['cart_id'] = $ran;
    $inventory_arr=[];
    $inventory_arr = json_encode($request->data);
    foreach(json_decode($inventory_arr) as $arrdata){
        $arr['cart_id'] = $cat_id;
        $arr['device_id'] = $arrdata->device_id;
        $arr['inventory_id'] = $arrdata->inventory_id;
        $arr['location'] = $arrdata->location;
        $arr['price'] = $arrdata->price;
        $arr['date'] = $arrdata->date;
        $arr['quantity'] = $arrdata->quantity;
        $arr['product_name']=$arrdata->product_name;
        $arr['product_image']=$arrdata->product_image;
        if(empty($arrdata->user_id)){
           
               $dev = $arrdata->device_id;
               $inv = $arrdata->inventory_id;
               $data = DB::select("SELECT * FROM `user_cart_management` WHERE `device_id`='$dev' AND `inventory_id`='$inv'");
               if(count($data) != 0){
                foreach($data as $val){
                    $qunt = $val->quantity;
                }
                 $arr1 = $qunt+$arrdata->quantity;
                  DB::table('user_cart_management')->where('device_id',$dev)->where('inventory_id',$inv)->update(['quantity' => $arr1]);  
                 return response()->json(['status'=>1,'success'=>'successfully add to cart.']);
                }
                else{
                 AddCart::create($arr);
                //  echo "ffff";die;
                 return response()->json(['status'=>1,'success'=>'successfully add to cart.']);
                }
                
                }else{
                    // echo "hello";die;
                     $arr['user_id'] = $arrdata->user_id;
                 $dev = $arrdata->device_id;
                 $inv = $arrdata->inventory_id;
                  $data = DB::select("SELECT * FROM `user_cart_management` WHERE `device_id`='$dev'");
                //   echo "<pre>";print_r($data);die;
                    if(count($data) != 0){
                        // echo "helo";die;
                  foreach($data as $value){
                    $arr['cart_id'] = $value->cart_id;
                    $arr['device_id'] = $value->device_id;
                    $arr['inventory_id'] = $value->inventory_id;
                    $arr['location'] = $value->location;
                    $arr['price'] = $value->price;
                    $arr['date'] = $value->date;
                    $arr['quantity'] = $value->quantity;
                    $arr['user_id'] = $arrdata->user_id;
                    $arr['product_image'] = $value->product_image;
                    $arr['product_name'] = $value->product_name;
                    $data1 = DB::select("SELECT * FROM `user_cart_log` WHERE `user_id`='$arrdata->user_id' AND `inventory_id`='$value->inventory_id'");
                    // echo "<pre>";print_r($data1);die;
                   if($data1 > 0){
                        foreach($data1 as $val1){
                           $qunt1 = $val1->quantity;
                        }
                    $dev = $arrdata->device_id;
                     $inv =$value->inventory_id;
                     $arr2 = $qunt1+$value->quantity;
                      $query=DB::table('user_cart_log')->where('device_id',$dev)->where('inventory_id',$inv)->update(['quantity' => $arr2]);
                    //  echo "<pre>";print_r($query);die;
                       $delete = AddCart::where('device_id', $dev)->delete();
                //  echo "<pre>";print_r($delete);die;
                          if ($delete > 0) {
                               return response()->json(['status'=>1,'success'=>'successfully add to cart.']);
                            } else {
                                return response()->json(['status'=>0,'error'=>'have some issue.']);
                            }
                   }else{
                    //   echo "adsf";die;
                     AddLog::create($arr);
                      $delete = AddCart::where('device_id', $dev)->delete();
                //  echo "<pre>";print_r($delete);die;
                          if ($delete > 0) {
                               return response()->json(['status'=>1,'success'=>'successfully add to cart.']);
                            } else {
                                return response()->json(['status'=>0,'error'=>'have some issue.']);
                            }
                  }
                  }
                 
                }
                    else{
                        // echo "hel";die;
                    $data1 = DB::select("SELECT * FROM `user_cart_log` WHERE `user_id`='$arrdata->user_id' AND `inventory_id`='$arrdata->inventory_id'");
                   if(count($data1) != 0){
                        foreach($data1 as $val1){
                           $qunt1 = $val1->quantity;
                        }
                    
                     $arr2 = $qunt1+$arrdata->quantity;
                      $query=DB::table('user_cart_log')->where('device_id',$dev)->where('inventory_id',$inv)->update(['quantity' => $arr2]);
                       return response()->json(['status'=>1,'success'=>'successfully add to cart.']);
                   }else{
                    // echo "dhel;";die;
                         AddLog::create($arr);
                         
                    }        
           }
        }
                
       
     
    }  
    return response()->json(['status'=>1,'success'=>'successfully add to cart.']);
                     
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
    
    
    /**
    *
    * Get user cart lists
    */   

    public function usercarts(Request $request)
    {
        if(!empty($request->user_id)) {
          
          $product=DB::table("user_cart_log")->select('user_cart_log.*')->where('user_id','=',$request->user_id)->get();
          
          if(count($product) == 0) {
    
            $data['success'] = 404;
            $data['message'] = 'product not found';
            return response()->json(compact('data'));
    
          }else{
    
            $data['success'] = 200;
            $data['message'] = 'list of prouct';
            return response()->json([
              'product' => $product,
            ]);
    
          }
    
        } else{
          $data['success'] = 404;
          $data['message'] = 'user id field is required.';
          return response()->json(compact('data'));
        }
    }
}
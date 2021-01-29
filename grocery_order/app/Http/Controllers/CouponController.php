<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Addcoupon;
use App\UserCoupon;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Guzzle\Http\Client;
use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class CouponController extends Controller
{
    public function index(){
        $product = DB::table('user_coupon')->orderBy('id','DESC')->get();
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
public function add(Request $request){
    $arr = $request->all();
    if(!empty($request->user_id))
    {
        
     $query = DB::select("SELECT * FROM `user_use_coupen` WHERE `user_id`=$request->user_id AND `coupon_id`=$request->coupon_id");
    //  echo "<pre>";print_r($query);die;
     if(count($query) > 0){
        //  echo"asdf";die;
         foreach($query as $val){
             $count = $val->count;
         }
         $use_coupon = $count+1;
         $query = DB::select("SELECT * FROM `user_use_coupen` WHERE `user_id`=$request->user_id AND `coupon_id`=$request->coupon_id");
         foreach($query as $value){
             if($value->user_id == $request->user_id && $value->coupon_id == $request->coupon_id){
         UserCoupon::where('coupon_id','=', $request->coupon_id)
       ->update([
           'count' => $use_coupon
        ]);
         }
         }
         return response()->json(['status'=>1,'success'=>'counpon update.']);
     }
    else{
        // echo"asdf1";die;
              $cat_id = rand(1000,1000000000);
              $string  = $request->user_id;
              $result = substr($string, 0, 2);
              $str=strtoupper($result);
              $ran = $str.$cat_id;
              $arr['user_coupen_id'] = $ran;
              $arr['count'] = 1;
       $query = DB::table('user_use_coupen')->insert($arr);
            if($query > 0){
              return response()->json(
                  ['status'=>1,
                  'success'=>'successfully add coupon.',
                  ]);
            }else{
                return response()->json(['status'=>0,'error'=>'coupon not store.']);
            }
            
        
    }
    }else{
       return response()->json(['status'=>0,'error'=>'user Id does not exist.']);
    }
}
public function add_coupon(Request $request){
    // echo "asdf";die;
    $arr = $request->all();
    $cat_id = rand(1000,1000000000);
    $string  = $request->category;
    $result = substr($string, 0, 2);
    $str=strtoupper($result);
    $ran = $str.$cat_id;
    $arr['coupen_id'] = $ran;
    $arr['admin_product_category'] = $request->category;
    $arr['admin_product_sub_category'] = $request->sub_category;
    $arr['code'] = $request->pincode;
    $arr['use_per_user']= $request->pre_user;
    $arr['date_from']= $request->from;
    $arr['date_to']= $request->to;
    if($file = $request->file('image')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('../image', $name);
                $path ='https://kamakhyaits.com/grocery_order/public/image/'.$name;
                $arr['image']=$path;
            }
            $query = Addcoupon::create($arr)->id;
            if($query > 0){
              return response()->json(
                  ['status'=>200,
                  'success'=>'successfully add coupon.',
                  ]);
            }else{
                return response()->json(['status'=>201,'error'=>'coupon not store.']);
            }
    
    
}
 
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\Useraddress;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class UseraddressController extends Controller
{

  public function index(Request $request){

    	$data=DB::table('user_address')->where('user_id','=',$request->user_id)->orderBy('id','DESC')->get();
    // 	echo"<pre>";print_r($product);die;
    	if(count($data) > 0){
             return response()->json(
                 ['status'=>1,
                 'success'=>'data was found',
                 'data'=>$data
                 ]);
    	}else{
    	
        return response()->json(['status'=>0,'error'=>'data not found.']);
   
    }
  }
     public function store(Request $request)
 {
      
             $arr = $request->all(); 
             $cat_id = rand(1000,1000000000);
              $string  = $request->user_name;
              $result = substr($string, 0, 2);
              $str=strtoupper($result);
              $ran = $str.$cat_id;
              $arr['address_id'] = $ran;
              $query = DB::table('user_address')->insert($arr);
            if($query > 0){
              return response()->json(
                  ['status'=>1,
                  'success'=>'successfully add address.',
                  ]);
            }else{
                return response()->json(['status'=>0,'success'=>'address not store.']);
            }
            
            
          
             
 }
  public function update(Request $request)
 {
       $arr = $request->all();
       $query = Useraddress::where('address_id', $request->address_id)->update(['address_line_1' => $request->address_line_1,'land_mark'=> $request->land_mark,'city'=>$request->city,
       'pin_code'=> $request->pin_code,'state'=>$request->state,'address_type'=>$request->address_type]);
    //   echo "<pre>";print_r($query);die;
       if($query > 0){
              return response()->json(
                  ['status'=>1,
                  'success'=>'successfully update address.',
                  ]);
            }else{
                return response()->json(['status'=>0,'success'=>'address not update.']);
            }
 }
   public function delete($id)
    {
        $delete = Shop::where('id', $id)->delete();

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
 
}
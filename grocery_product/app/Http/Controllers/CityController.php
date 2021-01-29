<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\City;
use App\Pincode;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class CityController extends Controller
{
   public function index(){

    	$product=DB::table('admin_city_area')->get();
    // 	echo"<pre>";print_r($product);die;
    	if($product == null){
    		$data['success'] = 201;
         $data['message'] = 'city not found';
        return response()->json(compact('data'));
    	}
    	
    	$data['success'] = 200;
    	$data['message'] = 'list of category';

        
        return response()->json($product);
   
    }
       public function pincode(){

    	$product=DB::table('admin_city_pincode')
    	->join('admin_city_area','admin_city_area.city_id','=','admin_city_pincode.city_id')
    	->select('admin_city_pincode.*','admin_city_area.city_name')
    	->get();
    // 	echo"<pre>";print_r($product);die;
    	if(count($product) == 0){
    	 $data['success'] = 201;
         $data['message'] = 'city not found';
        return response()->json(compact('data'));
    	}else{
    	$data['success'] = 200;
    	$data['message'] = 'list of city';
        return response()->json($product);
    	}
    }
     public function store(Request $request)
 {
      $checker = 0;
       $arr = $request->all();
              $validator = Validator::make($request->all(), [
                    'city_name' => 'required',
                ]);
               if ($validator->fails()) {
                return response()->json(['status'=>202,'success'=>'city name required.']);
            }else{
             
           $checker = City::select('city_name')->where('city_name','=',$request->city_name)->exists();
         	 if($checker > 0){
         	 return response()->json(['status'=>201,'success'=>'city already exist.']);
         	 }
         	 else{
         	    $string  = $request->city_name;
                $result = substr($string, 0, 2);
                $str=strtoupper($result);
                $ran = $str.$request->city_id;
                $arr['city_id'] = $ran;
                City::create($arr);
             $city=DB::table('admin_city_area')->select('city_id')->where('city_id','=',$request->city_id)->get();
             foreach($city as $value){
                 $arr['city_id'] = $value->city_id;
             }
             $id = $arr['city_id'];
             return response()->json(['status'=>200,'success'=>'city saved successfully.','id'=>$id]);
         	 }
    }
 }
 
      public function pincodestore(Request $request)
 {
      $checker = 0;
       $arr = $request->all();
            $string  = $request->city_id;
            $result = substr($string, 0, 2);
            $str=strtoupper($result);
            
            $ran = $str.$request->pincode_id;
            $arr['pincode_id'] = $ran;
            $arr['pincode'] = $request->pin_code;
              $validator = Validator::make($request->all(), [
                    'pin_code' => 'required',
                ]);
               if ($validator->fails()) {
                return response()->json(['status'=>202,'success'=>'pincode required.']);
            }else{
            
             $checker = Pincode::select('pincode')->where('pincode','=',$request->pin_code)->exists();
         	 if($checker > 0){
         	 return response()->json(['status'=>201,'success'=>'pincode already exist.']);
         	 }
         	 else{
         	   
                  $qery =Pincode::create($arr)->id;
                //   echo "<pre>";print_r($qery);die;
                  if($qery > 1){
                    //   echo "asdf1";die;
             return response()->json(['status'=>200,'success'=>'pincode saved successfully.']);
                  }else{
                    //   echo "asdf";die;
                      return response()->json(['status'=>201,'success'=>'pincode already exist.']);
                  }
         	 }
             
    }
 }
 
 public function pincode_service(Request $request)
 {
           $arr = $request->all();
           $query = DB::select("select * from admin_city_pincode where pincode=$request->pin_code and pin_service_state='true' ");
           if(count($query) > 0){
           return response()->json(['status'=>200,'success'=>'service is available']);
           }else{
           return response()->json(['status'=>200,'success'=>'service not available.']);    
           }
 }
 
 public function update(Request $request)
 {
         $arr = $request->all();
           City::find($request->id)->update($arr);
         return response()->json(['status'=>200,'success'=>'city update successfully.']);
 }
 
 public function pincode_update(Request $request)
 {
    //  echo $request->id;die;
     $arr = $request->all();
           Pincode::find($request->id)->update($arr);
         return response()->json(['status'=>200,'success'=>'pincode update successfully.']);
 }
    public function pincodedelete($id)
    {
        $delete =DB::table('admin_city_area')->where('id', $id)->delete();

        // echo $delete;die;
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
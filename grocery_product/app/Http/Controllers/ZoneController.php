<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\Zone;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class ZoneController extends Controller
{
   public function index(){

    	$zone=DB::table('admin_zone')
    	->join('admin_city_area','admin_city_area.city_id','=','admin_zone.city_id')
    	->select('admin_zone.*','admin_city_area.city_name')
    	->orderBy('id','DESC')->get();
    // 	echo"<pre>";print_r($zone);die;
    	if(count($zone) == 0){
    		$data['success'] = 201;
         $data['message'] = 'Zone not found';
        return response()->json(compact('data'));
    	}
    	
    	$data['success'] = 200;
    	$data['message'] = 'list of Zone';

        
        return response()->json($zone);
   
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
                    'zone_name' => 'required',
                ]);
               if ($validator->fails()) {
                return response()->json(['status'=>202,'success'=>'Zone name required.']);
            }else{
             
           
         	    $string  = $request->zone_name;
                $result = substr($string, 0, 2);
                $str=strtoupper($result);
                $ran = $str.$request->zone_id;
                $arr['zone_id'] = $ran;
                $arr['pin_code'] = $request->pincode;
                $arr['city_id'] = $request->city;
                Zone::create($arr);
             
             return response()->json(['status'=>200,'success'=>'zone saved successfully.']);
         
    }
 }
 
      public function pincodestore(Request $request)
 {
      $checker = 0;
       $arr = $request->all();
              $validator = Validator::make($request->all(), [
                    'pincode' => 'required',
                ]);
               if ($validator->fails()) {
                return response()->json(['status'=>202,'success'=>'pincode required.']);
            }else{
             $checker1 = Pincode::select('city_id')->where('city_id','=',$request->city_id)->exists();
             if($checker1 > 0)
             {
               return response()->json(['status'=>203,'success'=>'city id already exist.']);   
             }else{
             $checker = Pincode::select('pincode')->where('pincode','=',$request->pincode)->exists();
         	 if($checker > 0){
         	 return response()->json(['status'=>201,'success'=>'pincode already exist.']);
         	 }
         	 else{
         	    $string  = $request->pincode;
                $result = substr($string, 0, 2);
                $str=strtoupper($result);
                $ran = $str.$request->pincode_id;
                $arr['pincode_id'] = $ran;
                // echo $ran;die;
                  Pincode::create($arr);
             return response()->json(['status'=>200,'success'=>'pincode saved successfully.']);
         	 }
             }
    }
 }
 public function update(Request $request)
 {
         $arr = $request->all();
           City::find($request->id)->update($arr);
         return response()->json(['status'=>200,'success'=>'city update successfully.']);
 }
 
  public function assignzone(Request $request)
 {  
        // echo $request->zone_name;
        // echo $request->driver_id;die;
           $query = Zone::where('zone_name', $request->zone_name)->update(['driver_name' => $request->driver_id]);
           if($query > 0){
          return response()->json(['status'=>200,'success'=>'successfully assign zone.']);
           }else{
               return response()->json(['status'=>401,'error'=>'have some issue']);
           }
 }
 public function requestpincode(Request $request){
     $zone = DB::table('admin_zone')->where('pin_code',$request->pin_code)->get();
     if(count($zone) == 0){
    		$data['success'] = 201;
         $data['message'] = 'Zone not found';
        return response()->json(compact('data'));
    	}
    	
    	$data['success'] = 200;
    	$data['message'] = 'list of Zone';

        
        return response()->json($zone);
 }
 public function pincodelist(){ 
   $pincode = DB::table('admin_city_area')
   ->join('admin_city_pincode','admin_city_pincode.city_id','=','admin_city_area.city_id')->orderBy('admin_city_pincode.pincode_id','DESC')
   ->get();
     if(count($pincode) == 0){
    		$data['success'] = 201;
         $data['message'] = 'pincode not found';
        return response()->json(compact('data'));
    	}
    	$data['success'] = 200;
    	$data['message'] = 'list of pincode';
        return response()->json($pincode);
     
 }
   
}
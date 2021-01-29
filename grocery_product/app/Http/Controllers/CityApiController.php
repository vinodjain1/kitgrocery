<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\City;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class CityApiController extends Controller
{
   public function api(){

    	$product=DB::table('admin_city_area')->get();
    // 	echo"<pre>";print_r($product);die;
    	if($product == null){
    		$data['success'] = 200;
         $data['message'] = 'city not found';
        return response()->json(compact('data'));
    	}
    	
    	$data['success'] = 200;
    	$data['message'] = 'list of city';

        
        return response()->json($product);
   
    }
     public function store(Request $request)
 {
      $checker = 0;
     
        $string  = $request->city_name;
            $result = substr($string, 0, 2);
            $str=strtoupper($result);
            
            $ran = $str.$request->city_id;
            $arr['city_id'] = $ran;
            City::create($arr);
            return response()->json(['status'=>200,'success'=>'city saved successfully.']);
            
        }
 public function update(Request $request)
 {
         $arr = $request->all();
           City::find($request->id)->update($arr);
         return response()->json(['status'=>200,'success'=>'city update successfully.']);
 }
   
}
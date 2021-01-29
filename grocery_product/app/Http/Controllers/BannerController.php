<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\Banner;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class BannerController extends Controller
{
   public function index(){

    	$product=DB::table('tbl_banner')
    	->join('admin_city_area','admin_city_area.city_id','=','tbl_banner.city_id')->select('tbl_banner.*','admin_city_area.city_name')
    	->orderBy('tbl_banner.id','DESC')->get();
    // 	echo"<pre>";print_r($product);die;
    	if($product == null){
    		$data['success'] = 200;
         $data['message'] = 'product not found';
        return response()->json(compact('data'));
    	}
    	
    	$data['success'] = 200;
    	$data['message'] = 'list of category';

        
        return response()->json($product);
   
    }
     public function store(Request $request)
 {
     if($file = $request->file('brand_image')) {
    $name = time() . $file->getClientOriginalName();
    $file->move('../image', $name);
    $path ='https://kamakhyaits.com/grocery_user/public/image/'.$name;
    $arr['brand_image']=$path;
    }
     $arr = $request->all();
      Banner::create($arr);
             return response()->json(['status'=>200,'success'=>'pincode saved successfully.']);      
 }
 public function update(Request $request)
 {
      $arr = $request->all();
              $validator = Validator::make($request->all(), [
                    'brand_name' => 'required',
                ]);
               if ($validator->fails()) {
                return response()->json(['status'=>202,'success'=>'category name required.']);
            }else{
       if($file = $request->file('brand_image')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('../image', $name);
                $path ='https://kamakhyaits.com/grocery_user/public/image/'.$name;
                $arr['brand_image']=$path;
            }
            
            Brand::create($arr);
             return response()->json(['status'=>200,'success'=>'pincode saved successfully.']);
 }
 } 
  public function delete($id)
    {
        $delete = Brand::where('id', $id)->delete();

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
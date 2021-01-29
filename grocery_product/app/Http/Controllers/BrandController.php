<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\Brand;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class BrandController extends Controller
{
   public function index(){

    	$product=DB::table('brand_table')->orderBy('brand_table.id','DESC')->get();
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
    
    $checker = Brand::select('brand_name')->where('brand_name',$request->brand_name)->exists();
    
      if($checker == $request->brand_name){
      return response()->json(['status'=>201,'success'=>'brand name already exist.']);
      }
      else{
          $cat_id = rand(1000,1000000000);
          $string  = $request->brand_name;
            $result = substr($string, 0, 2);
            $str=strtoupper($result);
            $ran = $str.$cat_id;
            $arr['brand_id'] = $ran;
            
     Brand::create($arr);
     return response()->json(['status'=>200,'success'=>'brand saved successfully.']);
      }
            }
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
            
            Brand::find($request->id)->update($arr);
       return response()->json(['status'=>200,'success'=>'user update successfully.']);
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
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\SubCategory;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class SubCategoryController extends Controller
{
   public function index(){

    	$product=DB::table("admin_product_sub_category")->join('admin_product_category','admin_product_category.product_category_id','=', 'admin_product_sub_category.product_category_id')->select('admin_product_sub_category.*','admin_product_category.product_category_id as cat_id','admin_product_category.product_category_name as sub_cat_name')->orderBy('admin_product_sub_category.id','DESC')->get();
    
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
                    'product_sub_category_name' => 'required',
                    'product_category_id' => 'required',
                ]);
               if ($validator->fails()) {
                return response()->json(['status'=>202,'success'=>'category name required.']);
            }else{
       if($file = $request->file('featured_image')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('../image', $name);
                $path ='https://kamakhyaits.com/grocery_product/public/image/'.$name;
                $arr['featured_image']=$path;
            }
           
            $checker = SubCategory::select('product_sub_category_name')->where('product_sub_category_name',$request->product_sub_category_name)->exists();    
         	if($checker == $request->product_sub_category_name){
         	return response()->json(['status'=>201,'success'=>'sub category already exist.']);
         	}
         	else{
         	
            $string  = $request->product_sub_category_name;
            $result = substr($string, 0, 2);
            $str=strtoupper($result);
            $ran = $str.$request->product_sub_category_id;
            $arr['product_sub_category_id'] = $ran;
            SubCategory::create($arr);
            return response()->json(['status'=>200,'success'=>'category saved successfully.']);
         	}
            }
 }
 public function update(Request $request)
 {
      $arr = $request->all();
              $validator = Validator::make($request->all(), [
                    'product_sub_category_name' => 'required',
                    'product_category_id' => 'required',
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
            
            SubCategory::find($request->id)->update($arr);
       return response()->json(['status'=>200,'success'=>'user update successfully.']);
            }
 }
     public function delete($id)
    {
        $delete = SubCategory::where('id', $id)->delete();

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
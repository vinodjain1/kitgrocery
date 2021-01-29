<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\Category;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class CategoryController extends Controller
{
   public function index(){

    	$product=DB::table('admin_product_category')->orderBy('id','DESC')->get();
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
      $checker = 0;
       $arr = $request->all();
              $validator = Validator::make($request->all(), [
                    'product_category_name' => 'required',
                ]);
               if ($validator->fails()) {
                return response()->json(['status'=>202,'success'=>'category name required.']);
            }else{
                // echo $request->file('category_featured_image');die;
               if($file = $request->file('category_featured_image')) {
                //   echo "dd";die;
                 $name = time() . $file->getClientOriginalName();
                $file->move('image', $name);
                $path ='https://kamakhyaits.com/grocery_product/public/image/'.$name;
                $arr['category_featured_image']=$path;
            }
            
           $checker = Category::select('product_category_name')->where('product_category_name','=',$request->product_category_name)->exists();
         	 if($checker > 0){
         	 return response()->json(['status'=>201,'success'=>'category already exist.']);
         	 }
         	 else{
         	    $string  = $request->product_category_name;
                $result = substr($string, 0, 2);
                $str=strtoupper($result);
                $ran = $str.$request->product_category_id;
                $arr['product_category_id'] = $ran;
                // echo $ran;die;
             Category::create($arr);
             return response()->json(['status'=>200,'success'=>'category saved successfully.']);
         	 }
    }
 }
 public function update(Request $request)
 {
      $checker = 0;
       $arr = $request->all();
              $validator = Validator::make($request->all(), [
                    'product_category_name' => 'required',
                ]);
               if ($validator->fails()) {
                return response()->json(['status'=>202,'success'=>'category name required.']);
            }else{
               if($file = $request->file('category_featured_image')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('../image', $name);
                $path ='https://kamakhyaits.com/grocery_product/public/image/'.$name;
                $arr['category_featured_image']=$path;
            }
           
              Category::find($request->id)->update($arr);
             return response()->json(['status'=>200,'success'=>'category saved successfully.']);
         	 }
            }
//   public function delete($id)
//     {
//          $id = $id;
//         $post = Category::find($id)->delete();
//          return response()->json(['status'=>200,'success'=>'successfully delete recorde.']);
//     }
     public function delete($id)
    {
        $delete = Category::where('id', $id)->delete();

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
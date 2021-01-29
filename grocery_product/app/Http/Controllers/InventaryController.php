<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\Inventary;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class InventaryController extends Controller
{
   public function index(){

    	$product=DB::table("admin_product_inventary")
    	->join('admin_product','admin_product.product_sku','=', 'admin_product_inventary.product_sku')
    	->join('admin_product_variant','admin_product_variant.variant_sku','=', 'admin_product_inventary.variant_sku')
    	->select('admin_product_inventary.*','admin_product.product_sku as p_sku','admin_product.featured_image as product_image','admin_product_variant.variant_sku as v_sku')
    	->orderBy('admin_product_inventary.id','DESC')->get();
    
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
                    'mrp' => 'required',
                ]);
               if ($validator->fails()) {
                return response()->json(['status'=>202,'success'=>'category name required.']);
            }else{
            $string  = $request->discount_type;
            $result = substr($string, 0, 2);
            $str=strtoupper($result);
            $ran = $str.$request->inventory_id;
            $arr['inventory_id'] = $ran;
            Inventary::create($arr);
            return response()->json(['status'=>200,'success'=>'category saved successfully.']);
            }  	
 }
 public function update(Request $request)
 {
      $arr = $request->all();

       if($file = $request->file('featured_image')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('../image', $name);
                $path ='https://kamakhyaits.com/grocery_user/public/image/'.$name;
                $arr['featured_image']=$path;
            }
            
            Inventary::find($request->id)->update($arr);
       return response()->json(['status'=>200,'success'=>'user update successfully.']);
 }

 public function updatestatus(Request $request)
    {
        $st = $request->country_id;   
        $status = substr($st, strpos($st, " ") + 1); 
       
        $needle    = ' ';
        $id = strstr($st, $needle, true);
         if($status == 'H'){
          $data['states'] = Inventary::where('id', $id)->update(['status' => 'Hot Deal']);
         }else if($status == 'M'){
            $data['states'] = Inventary::where('id', $id)->update(['status' => 'Must By']); 
         }else{
             $data['states'] = Inventary::where('id', $id)->update(['status' => 'Recommended']);
         }
        return response()->json($data);
    }
 
    public function delete($id)
    {
        $delete = Inventory::where('id', $id)->delete();

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
     public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
}
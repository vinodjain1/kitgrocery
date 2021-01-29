<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\Supplier;
use App\Userlist;
use App\User;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class SupplierController extends Controller
{
   public function index(){

    	$product=DB::table('suppliers')
    	->join('tbl_shop_detail','tbl_shop_detail.supplier_id','=','suppliers.supplier_id')
    	->select('suppliers.*','tbl_shop_detail.pincode','tbl_shop_detail.shop_name')
    	->orderBy('id','DESC')->get();
    // 	echo"<pre>";print_r($product);die;
    	if($product == null){
    		$data['success'] = 200;
         $data['message'] = 'product not found';
        return response()->json(compact('data'));
    	}
    	
    	$data['success'] = 200;
    	$data['message'] = 'list of product';

        
        return response()->json($product);
   
    }
     public function store(Request $request)
 {
      
      $arr = $request->all();

               if($file = $request->file('image')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('../image', $name);
                $path ='https://kamakhyaits.com/grocery_user/public/image/'.$name;
                $arr['image']=$path;
            }
            $arr['password'] = app('hash')->make($request->password);
             $arr['api_token'] = $request->password;
              $checker1 = Supplier::select('phone')->where('phone',$request->phone)->exists();
              $checker = Supplier::select('email')->where('email',$request->email)->exists();
             	 if($checker == $request->email){
             	 return response()->json(['status'=>201,'success'=>'email already exist.']);
             	 }else if($checker1 == $request->phone){
             	    	 return response()->json(['status'=>202,'success'=>'phone already exist.']); 
             	 }
             	 else{
             	    $string  = $request->name;
                    $result = substr($string, 0, 2);
                    $str=strtoupper($result);
                    $ran = $str.$request->supplier_id;
                    $arr['supplier_id'] = $ran;
             Supplier::create($arr);
             $supplier=DB::table('suppliers')->select('email','supplier_id')->where('email','=',$request->email)->get();
             foreach($supplier as $value){
                 $arr['id'] = $value->supplier_id;    
                 
             }
             $id = $arr['id'];
             return response()->json(['status'=>200,'success'=>'supplier saved successfully.','id'=>$id]);
             	 }
 }
 public function update(Request $request)
 {
      //$arr = $request->all();

      /* if($file = $request->file('image')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('../image', $name);
                $imagepath ='https://kamakhyaits.com/grocery_user/public/image/'.$name;
                //$arr['image']=$path;
            }
             $password = app('hash')->make($request->password);
             $api_token = $request->password;*/
             //$arr['id'] = $request->id;
             $checker1 = Supplier::where('supplier_id',$request->id)->first();
             //dd($checker1);
             if($checker1){
              //$query = Supplier::find($request->id)->update($arr);
              Supplier::where('supplier_id',$request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'dob' => $request->dob,
                'adhar_number' => $request->adhar_number,
                'address' => $request->address
                ]);
               return response()->json(['status'=>200,'success'=>'supplier update successfully.']);
               }else{
                 return response()->json(['status'=>201,'success'=>'not updated.']); 
               }
            
 }
public function delete($id)
{
        $delete = Supplier::where('id', $id)->delete();

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
  
    public function viewprofile(Request $request)
    {
         $arr = $request->all();
        
         if(!empty($request->supplier_id)){
          $value = Supplier::where('supplier_id',$request->supplier_id)->get();
          	if(count($value) == 0){
      	   	$data['success'] = 404;
            $data['message'] = 'data not found';
            return response()->json(compact('data'));
      	    }else{
      	     $data['success'] = 200;
        	$data['message'] = 'your profile';
        	$data['id'] = $value[0]->id;
        	$data['user_type'] = $value[0]->user_type;
        	$data['supplier_id'] = $value[0]->supplier_id;
        	$data['name'] = $value[0]->name;
        	$data['email'] = $value[0]->email;
        	$data['phone'] = $value[0]->phone;
        	$data['dob'] = $value[0]->dob;
        	$data['adhar_number'] = $value[0]->adhar_number;
        	$data['address'] = $value[0]->address;
        	
        	//Get shop_detail
            $shop_detail = DB::table('tbl_shop_detail')->where('supplier_id', $value[0]->supplier_id)->first(['week_off']);

            if(!empty($shop_detail) && $shop_detail->week_off=='on') {
                $data['vaction'] = true;
            }elseif(!empty($shop_detail) && $shop_detail->week_off=='off') {
                $data['vaction'] = false;
            }else{
                $data['vaction'] = true;
            }
            return response()->json([
                'data' => $data,
                
            ]);
    	
    	}
        }else{
       return response()->json(['status'=>404,'message'=>'user id not found']);
        }
    }
    
    
    public function vacationupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|exists:tbl_shop_detail,supplier_id',
            'vaction' => 'required|in:on,off',
        ],[
            'supplier_id.required' => 'The :attribute field is required.',
            'supplier_id.exists' => 'The :attribute field is invalid.',
            'vaction.required' => 'The :attribute field is required.',
            'vaction.in' => 'The vacation must be on or off.',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'error' => $validator->errors()->first()]);
        }

        $vaction = $request->vaction;
        $supplier_id = $request->supplier_id;

        $shop_detail = DB::table('tbl_shop_detail')->where('supplier_id', $supplier_id)->first(['week_off']);

        if($shop_detail) {
            DB::table('tbl_shop_detail')
                ->where('supplier_id', $supplier_id)
                ->update(['week_off' => $vaction]);

           return response()->json(['status'=>200,'success'=>'supplier vaction update successfully.']);
       }else{
         return response()->json(['status'=>201,'success'=>'not updated.']);
       }
    }
          
    
   
}
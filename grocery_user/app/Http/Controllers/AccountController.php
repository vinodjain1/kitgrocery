<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\Account;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class AccountController extends Controller
{

 public function index(){

    	$product=DB::table('tbl_account_detail')->orderBy('tbl_account_detail.id','DESC')->get();
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

            
              $checker1 = Account::select('account_number')->where('account_number',$request->account_number)->exists();
               $checker2 = Account::select('pan_number')->where('pan_number',$request->pan_number)->exists();
             	 if($checker1 > 0){
             	     
             	 return response()->json(['status'=>201,'success'=>'account number already exist.']);
             	 }else if($checker2 > 0){
             	     return response()->json(['status'=>203,'success'=>'Pan Number already exist.']);  
             	 }
             	 else{
             	     $cat_id = rand(1000,1000000000);
             	    $string  = $request->bank_name;
                    $result = substr($string, 0, 2);
                    $str=strtoupper($result);
                    $ran = $str.$cat_id;
                    $arr['account_id'] = $ran;
             Account::create($arr);
             return response()->json(['status'=>200,'success'=>'bank detail saved successfully.']);
             	 }
 }
 
 
 
public function accountDetail(Request $request)
 {
      
                $accountDetail = Account::where('supplier_id',$request->supplier_id)->get();
                if($accountDetail){
                return response()->json(['status'=>200,'success'=>'bank detail successfully.','data' => $accountDetail]);
                }else{
                    return response()->json(['status'=>401,'success'=>'No bank details found.']);
                }
             	 
 }
 
 
 
 public function store1(Request $request)
 {
      
      $arr = $request->all();

             Account::create($arr);
             return response()->json(['status'=>200,'success'=>'bank detail saved successfully.']);
             	 
 }
  public function update(Request $request)
 {
       $arr = $request->all();
       Account::find($request->id)->update($arr);
       return response()->json(['status'=>200,'success'=>'shop detail update successfully.']);
 }
  public function account_update_android(Request $request){
     if(!empty($request->supplier_id)){
     $query = Account::where('supplier_id', $request->supplier_id)
     ->update([
         'bank_name' => $request->bank_name,
         'account_number' => $request->account_number,
         'account_type' => $request->account_type,
         'ifsc_code' => $request->ifsc_code,
         'pan_number' => $request->pan_number,
         ]);
         
     if($query){
          return response()->json(['status'=>200,'success'=>'Account detail update successfully.']);
     }else{
          return response()->json(['status'=>401,'success'=>'Account detail not update.']);
     }
     }else{
         return response()->json(['status'=>401,'success'=>'Supplier id is require.']); 
     }
 }
   public function delete($id)
    {
        $delete = Account::where('id', $id)->delete();

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
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

    	$product=DB::table('tbl_account_detail')->get();
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
              $checker = Account::select('ifsc_code')->where('ifsc_code',$request->ifsc_code)->exists();
             	 if($checker > 0){
             	     
             	 return response()->json(['status'=>201,'success'=>'account number already exist.']);
             	 }else if($checker1 > 0){
             	     
             	    	 return response()->json(['status'=>202,'success'=>'ifsc code already exist.']); 
             	 }
             	 else{
             	    $string  = $request->bank_name;
                    $result = substr($string, 0, 2);
                    $str=strtoupper($result);
                    $ran = $str.$request->account_id;
                    $arr['account_id'] = $ran;
             Account::create($arr);
             return response()->json(['status'=>200,'success'=>'bank detail saved successfully.']);
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
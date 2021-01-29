<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\Userlist;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class UserController extends Controller
{

   
    public function index(){

    	$product=DB::table('users')->where('user_type','=','user')->get();
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
             $checker1 = Userlist::select('user_type','phone')->where('phone',$request->phone)->where('user_type',$request->user_type)->exists();
              $checker = Userlist::select('email','user_type','phone')->where('email',$request->email)->where('phone',$request->phone)->where('user_type',$request->user_type)->exists();
             	 if($checker == $request->email){
             	 return response()->json(['status'=>201,'success'=>'email already exist.']);
             	 }else if($checker1 == $request->phone){
             	    	 return response()->json(['status'=>202,'success'=>'phone already exist.']); 
             	 }
             	 else{
             	     $string  = $request->name;
                    $result = substr($string, 0, 2);
                    $str=strtoupper($result);
                    $ran = $str.$request->user_id;
                    $arr['user_id'] = $ran;
             Userlist::create($arr);
             return response()->json(['status'=>200,'success'=>'user saved successfully.']);
             	 }
             	 
 }
 
  public function update(Request $request)
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
            Userlist::find($request->id)->update($arr);
       return response()->json(['status'=>200,'success'=>'user update successfully.']);
 }
      public function delete($id)
    {
        $delete = Userlist::where('id', $id)->delete();

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
   
   
   /**
    * Get user detail
    */
    public function userDetail($id)
    {
        $user = DB::table('kitsosvw_grocery_user.users')->where('user_id', $id)->first();

        return response()->json($user);

    }
}
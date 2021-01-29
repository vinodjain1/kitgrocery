<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\Driver;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class DriverController extends Controller
{

    public function index(){

    	$driver=DB::table('tbl_drivers')->orderBy('id','DESC')->get();
    // 	echo"<pre>";print_r($product);die;
    	if($driver == null){
    		$data['success'] = 200;
         $data['message'] = 'driver not found';
        return response()->json(compact('data'));
    	}
    	
    	$data['success'] = 200;
    	$data['message'] = 'list of drivers';

        
        return response()->json($driver);
   
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
             $arr['password'] = base64_encode($request->password);
              $checker1 = Driver::select('phone')->where('phone',$request->phone)->exists();
              $checker = Driver::select('email')->where('email',$request->email)->exists();
             	 if($checker == $request->email){
             	 return response()->json(['status'=>201,'success'=>'email already exist.']);
             	 }else if($checker1 == $request->phone){
             	    	 return response()->json(['status'=>202,'success'=>'phone already exist.']); 
             	 }
             	 else{
             	      $string  = $request->name;
                    $result = substr($string, 0, 2);
                    $str=strtoupper($result);
                    $ran = $str.$request->driver_id;
                    $arr['driver_id'] = $ran;
             Driver::create($arr);
             return response()->json(['status'=>200,'success'=>'driver saved successfully.']);
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
            $arr['password'] = base64_encode($request->password);
            Driver::find($request->id)->update($arr);
       return response()->json(['status'=>200,'success'=>'supplier update successfully.']);
 }
         public function delete($id)
    {
        $delete = Driver::where('id', $id)->delete();

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
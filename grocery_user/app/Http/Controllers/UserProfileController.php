<?php
 
namespace App\Http\Controllers;
 use App\Userprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class UserProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
 
    }
 

    public function updateprofile(Request $request)
    {
        $arr = $request->except('id');//$request->all();
        
        if(!empty($request->id)){
         Userprofile::where('user_id', $request->id)->update($arr);
         return response()->json(['status'=>200,'message'=>'successfully update profile.']);
        }
       return response()->json(['status'=>201,'message'=>'your profile not updated.']);
     }
      public function updateaddress(Request $request)
    {
     $arr = $request->all();
       if(!empty($request->id)){
         Userprofile::find($request->id)->update($arr);
         return response()->json(['status'=>200,'message'=>'successfully update address.']);
        }
       return response()->json(['status'=>201,'message'=>'your address not updated.']);
     }
     
       public function viewprofile(Request $request)
    {
         $arr = $request->all();
        if(!empty($request->user_id)){
          $value = DB::table('users')->where('user_id','=',$request->user_id)->get();
          	if(count($value) == 0){
      	   	$data['success'] = 404;
            $data['message'] = 'data not found';
            return response()->json(compact('data'));
      	}else{
      	     $data['success'] = 200;
        	$data['message'] = 'your profile';
        	$data['id'] = $value[0]->id;
        	$data['user_id'] = $value[0]->user_id;
        	$data['name'] = $value[0]->name;
        	$data['email'] = $value[0]->email;
        	$data['phone'] = $value[0]->phone;
        	$data['dob'] = $value[0]->dob;
        	$data['gender'] = $value[0]->gender;
        	$data['image'] = $value[0]->image;
        	$data['pin_code'] = $value[0]->pin_code ? : '';
            $data['address'] = $value[0]->location ? : '';
            return response()->json([
                'data' => $data,
                
            ]);
    	
    	}
        }else{
       return response()->json(['status'=>404,'message'=>'user id not found']);
        }
     }
       public function delete(Request $request)
    {
     $arr = $request->all();
       if(!empty($request->address_id)){
         $query = DB::table('user_address')->where('address_id', $request->address_id)->delete();
         if(!empty($query)){
         return response()->json(['status'=>1,'message'=>'successfully delete address.']);
        }else{
             return response()->json(['status'=>0,'message'=>'address not delete.']);
        }
        }else{
       return response()->json(['status'=>0,'message'=>'address id is requred.']);
     }   
    }
    }  
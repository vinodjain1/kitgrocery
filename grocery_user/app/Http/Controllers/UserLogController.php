<?php
 
namespace App\Http\Controllers;
 use App\Userlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class UserLogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
 
    }
 

    public function userlog(Request $request)
    {
    $arr = $request->all();
    
     if(!empty($request->user_id)){
        //  echo "hello";die;
         $query = DB::table('tbl_users_log')->where('user_id','=',$request->user_id)->get();
        //  echo "<pre>";print_r($query);die;
         if(count($query) > 0){
    //   echo "hello1";die;
              Userlog::where('user_id', $request->user_id)->update(['session_valid' => $request->session_valid ]);
             $data = DB::table('tbl_users_log')->select('user_id','device_id','session_valid')->where('user_id','=',$request->user_id)->get();
         return response()->json(
             ['status'=>1,
             'message'=>'user device log.',
             'user' =>$data
             
             ]
             );
         }else{
            //  echo "hello2";die;
          Userlog::create($arr);
          $data = DB::table('tbl_users_log')->select('user_id','device_id','session_valid')->where('user_id','=',$request->user_id)->get();
         return response()->json(
             ['status'=>1,
             'message'=>'user device log.',
             'user' =>$data
             
             ]
             );
        }
       }else{
            return response()->json(
             ['status'=>0,
             'message'=>'user id empty.'
             
             ]
             );
       }
   
     }    
    }  
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Supplier;
use App\User;
use App\Driver;
use Illuminate\Support\Facades\Hash;
//use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class DriverLoginController extends Controller
{

public function signin()
{
    return view('signin');
}
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function postLogin(Request $request)
    {
        // echo "string";die;
        
        if($request->phone && $request->password)
        {
            $exist = Driver::where('phone',$request->phone)->first();
            $password = base64_encode($request->password);
            if ($password == $exist->password) {
               
            /*$data = [
                        'name' => $exist->name,
                        'phone' => $exist->phone,
                        'email' => $exist->email,
                        'token' => $exist->createToken('Personal Access Token')->accessToken
                    ];*/
                return response()->json(['status'=>200,'success'=>'Login successfully.','data'=>$exist]);
            }else{
                return response()->json(['status'=>401,'error'=>'Login Failed.']);
            }
        }
        elseif($request->email && $request->password)
        {
        //if (Auth::attempt(array('email' => $request->email, 'password' => $request->password))){
            
            
            $exist = Driver::where('email',$request->email)->first();
            $password = base64_encode($request->password);
            if ($password == $exist->password) {
            
             return response()->json(['status'=>200,'success'=>'Login successfully.','data'=>$exist]);
            }else{
                return response()->json(['status'=>401,'error'=>'Login Failed.']);
            }
        //}
        }

    }
}
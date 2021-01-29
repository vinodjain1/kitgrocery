<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Supplier;
use App\User;
use Illuminate\Support\Facades\Hash;
//use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class OtpSupplierController extends Controller
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
            $exist = User::where('phone',$request->phone)->first();
            if (Hash::check($request->password, $exist->password)) {
               
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
            
            
            $exist = Supplier::where('email',$request->email)->first();
            if (Hash::check($request->password, $exist->password)) {
            
             return response()->json(['status'=>200,'success'=>'Login successfully.','data'=>$exist]);
            }else{
                return response()->json(['status'=>401,'error'=>'Login Failed.']);
            }
        //}
    }elseif(empty($request->phone || $request->email)){
            $res['error'] = 400;
            $res['message'] = 'filed is missing';
           return response($res, 400);
        }else{
        if(!empty($request->phone)){
         $this->validate($request, [
        'phone' => 'required|digits:10'
         ]); 
        $pass=null;
        $var = null;
        $user_type = 'supplier';
        $cat_id = rand(1000,1000000000);
        $supplier_id = $cat_id;
        $checker = DB::table('suppliers')->where('phone',$request->phone)->exists();

        if(empty($checker)){
                $var = 'true';
                $password = "test@123";
                $value= 'true';
                $passpassword = app('hash')->make($password);
                $api_token = $password;
                $_reg = DB::insert("INSERT INTO suppliers(supplier_id,phone,password,api_token) VALUES(?,?,?,?)", [$supplier_id,$request->phone,$passpassword,$api_token]);
                      
       }else{
      // echo "string1";die;
              $hash = DB::select("SELECT m.phone, m.api_token FROM suppliers m WHERE m.phone = ?", [$request->phone]);
               $password = $hash[0]->api_token;
               
           }
            // echo $password;die;   
    //       try {
    //             $request->merge([
    //                   'password' => $password
                      
    //               ]);
    //         if (! $token = $this->jwt->attempt($request->only('phone', 'password'))) {
    //              $res['error'] = 200;
    //              $res['message'] = 'success';
    //              return response($res, 200);

    //         }

    //     } 
    //   catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
    //         $res['error'] = 500;
    //         $res['message'] = 'token expire';
    //         return response($res, 500);

    //     } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

    //         $res['error'] = 500;
    //         $res['message'] = 'invalide token';
    //         return response($res, 500);

    //     } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
    //         return response()->json(['token_absent' => $e->getMessage()], 500);

    //     }



    $username = "groupvastech@gmail.com";
    $hash = "6ac2040772c20228dfe6f58a687ab35b755f9f278817e60fe9cdc46704abc954";

    // Config variables. Consult http://api.textlocal.in/docs for more info.
    $test = "0";
    $phone=$request->phone;
    $otp=rand(1000,9999);
    $message ="Dear Valuable user, Your Verification code to Access the indian grocery is $otp .";
    $sender = "VASGRP"; 
    $message = urlencode($message);
    $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$phone."&test=".$test;
    $ch = curl_init('http://api.textlocal.in/send/?');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch); 
    curl_close($ch);
    //echo $result;
    $json = json_decode($result, true);

    if ($json['status']=="success") {
      if($var == 'true'){
          $hash = DB::table('suppliers')->select('id','supplier_id','phone','api_token')->where('phone','=',$request->phone)->get();
       $user_arr=array(
            "status" => "200",
            "otp" =>$otp,
            "id" => $hash[0]->id,
            'supplier_id' => $hash[0]->supplier_id,
            "phone" => $hash[0]->phone,
            "token" => '',
            "message" => "You do not have account, Please use OTP for registration."
           
        );
     }else{
        $hash = DB::table('suppliers')->select('id','supplier_id','phone','api_token')->where('phone','=',$request->phone)->get();
       $user_arr=array(
            "status" => "200",
            "otp" =>$otp,
            "id" => $hash[0]->id,
            'supplier_id' => $hash[0]->supplier_id,
            "phone" => $hash[0]->phone,
            "token" => '',
            "message" => "Login Successfully"
        );
     }
    }else{
        $user_arr=array(
            "status" => "201",
            "message" => "Invalid Opt",
        );
    }

      print_r(json_encode($user_arr));

}else{
        if(!empty($request->email)){
        $this->validate($request, [
        'email'=>'required|email'
         ]);
        $pass=null;
        $var=null;
        $user_type = 'supplier';
        $cat_id = rand(1000,1000000000);
        $user_id = $cat_id;
        $checker = DB::table('suppliers')->where('email',$request->email)->where('user_type',$user_type)->exists();

        if(empty($checker)){
                $var = 'true';
                $password = "test@123";
                $value= 'true';
                $passpassword = app('hash')->make($password);
                $api_token = $password;
                $_reg = DB::insert("INSERT INTO suppliers(supplier_id,email,password,api_token,user_type) VALUES(?,?,?,?,?)", [$user_id,$request->email,$passpassword,$api_token,$user_type]);
                      
       }else
       {
                // echo "string1";die;
              $hash = DB::select("SELECT m.email, m.api_token FROM suppliers m WHERE m.email = ?", [$request->email]);
               $password = $hash[0]->api_token;
               
        }
               
    //       try {
    //             $request->merge([
    //                 //   'user_type' => 'user',
    //                   'password' => $password
                      
    //               ]);
    //         if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {
    //              $res['error'] = 200;
    //              $res['message'] = 'success';
    //              return response($res, 200);

    //         }

    //     } 
    //   catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
    //         $res['error'] = 500;
    //         $res['message'] = 'token expire';
    //         return response($res, 500);

    //     } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

    //         $res['error'] = 500;
    //         $res['message'] = 'invalide token';
    //         return response($res, 500);

    //     } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
    //         return response()->json(['token_absent' => $e->getMessage()], 500);

    //     }


        $email=$request->email;
        $otp=rand(1000,9999);
        $to = $email;
        $message = "Dear Valuable user, Your Verification code to Access the indian grocery is $otp";
        $header = $to;
        $subject =  "Dear Valuable user, Your Verification code to Access the indian grocery is $otp";
        $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
          if($var == 'true'){
             $hash = DB::table('suppliers')->select('id','supplier_id','email','api_token')->where('email','=',$request->email)->where('user_type','=','supplier')->get();
             $user_arr=array(
            "status" => "200",
            "otp" =>$otp,
            "id" => $hash[0]->id,
            'supplier_id' => $hash[0]->supplier_id,
            "email" => $hash[0]->email,
            "token" => '',
            "message" => "You do not have account, Please use OTP for registration."
        );
        }
        else
        {
            $hash = DB::table('suppliers')->select('id','supplier_id','email','api_token')->where('email','=',$request->email)->where('user_type','=','supplier')->get();
            $user_arr=array(
                "status" => "200",
                "otp" =>$otp,
                "id" => $hash[0]->id,
                'supplier_id' => $hash[0]->supplier_id,
                "email" => $hash[0]->email,
                "token" => '',
                "message" => "Login Successfully"
            );
        }
    }else{
        $user_arr=array(
            "status" => "401",
            "message" => "Invalid Opt",
        );
    }

      print_r(json_encode($user_arr));

    }
}
}
}
}
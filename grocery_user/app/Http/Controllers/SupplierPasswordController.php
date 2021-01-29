<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class SupplierPasswordController extends Controller
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

    public function index(Request $request)
    {
     
        if(!empty($request->phone)){
         $this->validate($request, [
        'phone' => 'required|digits:10'
         ]);
        $pass=null;
        $var = null;          
        $cat_id = rand(1000,1000000000);
        $user_id = $cat_id;
        $checker = DB::table('suppliers')->where('phone',$request->phone)->exists();
        
        if(!empty($checker)){ 
         $username = "groupvastech@gmail.com";
        $hash = "6ac2040772c20228dfe6f58a687ab35b755f9f278817e60fe9cdc46704abc954";
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
       $user_arr=array(
           "status" => "1",
            "otp" =>$otp,
            "message" => "Your Otp is. $otp"
           
        );
     }
    else{
        $user_arr=array(
            "status" => "0",
            "message" => "Invalid Opt",
        );
    }
    }else{
        $user_arr=array(
            "status" => "0",
            "message" => "phone number don't exits",
        );
    }

      print_r(json_encode($user_arr));

    }
    else{
        if(!empty($request->email)){
        $this->validate($request, [
        'email'=>'required|email'
         ]);
        $pass=null;
        $var=null;
        $cat_id = rand(1000,1000000000);
        $user_id = $cat_id;
        $checker = DB::table('suppliers')->where('email',$request->email)->exists();

        if(!empty($checker)){
           

         $email=$request->email;
        $otp=rand(1000,9999);
        $to = $email;
        $message = "Dear Valuable user, Your Verification code to Access the indian grocery is $otp";
         $header = $to;
        $subject =  "Dear Valuable user, Your Verification code to Access the indian grocery is $otp";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
             
       $user_arr=array(
            "status" => "1",
            "otp" =>$otp,
          
            "message" => "check your email."
        );
    }else{
        $user_arr=array(
            "status" => "0",
            "message" => "Invalid Opt",
        );
    }
    }else{
        $user_arr=array(
            "status" => "0",
            "message" => "email don't exist",
        );
    }
        }
    else{
        $user_arr=array(
            "status" => "0",
            "message" => "please enter phone and email",
        );
    }
     
      print_r(json_encode($user_arr));
}
}
public function update(Request $request){
    
    $password = $request->password;
    if(!empty($password && $request->supplier_id)){
    $passpassword = app('hash')->make($password);
    $query = DB::table('suppliers')->where('supplier_id', $request->supplier_id)->update(['password' => $passpassword, 'api_token' => $password]);
     if(!empty($query)){
          $user_arr=array(
            "status" => "1",
            "message" => "successfully update password",
        );
         print_r(json_encode($user_arr));
     }else{
          $user_arr=array(
            "status" => "0",
            "message" => "password not updated have some issue",
        );
         print_r(json_encode($user_arr));
     }
      
    
}
else if(!empty($request->email && $request->password)){
    $passpassword = app('hash')->make($password);
    $query = Supplier::where('email', $request->email)->update(['password' => $passpassword,'api_token'=>$request->password]);
     if(!empty($query)){
          $user_arr=array(
            "status" => "1",
            "message" => "successfully update password",
        );
     }else{
          $user_arr=array(
            "status" => "0",
            "message" => "password not updated have some issue",
        );
     }
      
  print_r(json_encode($user_arr));  
}
else{
   $user_arr=array(
            "status" => "0",
           "message" => "field are required",
        ); 
        print_r(json_encode($user_arr)); 
}

}
}
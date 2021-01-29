<?php
include '../../config.php';
$email=$_POST['email'];
// echo base64_encode('12345');die;
$sql = "SELECT * FROM `vender` WHERE `email`='$email'";
// echo $sql;die;

$result = mysqli_query($con, $sql);
if($result > 0){
    while($row = mysqli_fetch_assoc($result)) {
      $email_id = $row['email'];
      $pass = base64_decode($row['password']);
    
    }
  if(!empty($email_id) && !empty($pass))
  {
  $to = $email_id;
  $subject = $langs == 'en' ? 'Salatcom Reset Password' : 'ااستعادة كلمة المرور  ';
  $message = 'كلكلمة المرور الخاصة بك هي : '.$pass; 
  $from = $email_id;
 
// Sending email
if(mail($to, $subject, $message)){
   $j->status  = "101";
   $j->message = $langs == 'en' ? "your password has been send on your mail id please check your mail id" : "تم ارسال كلمة المرور لـعنوان بريدك الالكتروني";
   echo json_encode($j);
} else{
    // return response()->json(['status'=>0,'message'=>'unable to send email. Please try again.']);
    $j->status  = "401";
   $j->message = $langs == 'en' ? "unable to send email. Please try again." : "لا يمكن ارسال البريد ، حاول مرة اخرى";
   echo json_encode($j);
}
  }else
  {
//   return response()->json(['status'=>0,'message'=>'email and password not found.']);
   $j->status  = "404";
   $j->message = $langs == 'en' ? "email does not exist." : "البريد الالكتروني غير مسجل";
   echo json_encode($j);
  }  
    
}else{
   $j->status  = "404";
   $j->message = $langs == 'en' ? "email does not exist." : "البريد الالكتروني غير مسجل";
   echo json_encode($j);
}


?>
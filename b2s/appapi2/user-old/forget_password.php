<?php
include '../../config.php';
$email=$_GET['email'];
// echo base64_encode('123456');die;
$sql = "SELECT * FROM `users` WHERE `email`='$email'";
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
  $subject = 'Service Market Place';
  $message = 'Your Password Is '.$pass; 
  $from = $email_id;
 
// Sending email
if(mail($to, $subject, $message)){
   $j->status  = "101";
   $j->message = "your password has been send on your mail id please check your mail id";
   echo json_encode($j);
} else{
    // return response()->json(['status'=>0,'message'=>'unable to send email. Please try again.']);
    $j->status  = "401";
   $j->message = "unable to send email. Please try again.";
   echo json_encode($j);
}
  }else
  {
//   return response()->json(['status'=>0,'message'=>'email and password not found.']);
   $j->status  = "404";
   $j->message = "email does not exist sugnup with facebook and gmail.";
   echo json_encode($j);
  }  
    
}else{
   $j->status  = "404";
   $j->message = "email does not exist sugnup with facebook and gmail.";
   echo json_encode($j);
}


?>
<?php
include '../../config.php';
include './fcm-message.php';
$email=$_POST['email'];
$pass=$_POST['password'];
$fcmtoken=$_POST['fcmToken'];
$password=base64_encode($pass);
 
$resultdata =$con->query("select * from `vender` where email='$email' AND password='$password' ");
 

$data=array();
$id=0;
$account_status=null;
while($row = mysqli_fetch_array($resultdata)){
     
    $id=$row['id'];
    $account_status=$row['account_status'];
}
if($account_status == 'active'){
if($id > 0)
{ 
    
$insert = $con->query("UPDATE `vender` SET `fcmtoken`='$fcmtoken',`loginAt`=NOW() WHERE  id='$id'");

$resultdata =$con->query("select * from `vender` where id='$id' "); 
while($row = mysqli_fetch_array($resultdata)){
    $profiledata=$row;
  
}      
   $data = array("to" => $fcmtoken,
                  "notification" => array( "code"=> "$welcomecode","title" => "$welcometitle", "body" => "$welcomebody","icon" => "$icon"));                                                                    
            $data_string = json_encode($data); 
            
             "The Json Data : ".$data_string; 
            
            $headers = array
            (
                 'Authorization: key=' . API_ACCESS_KEY, 
                 'Content-Type: application/json'
            );                                                                                 
                                                                                                                                 
            $ch = curl_init();  
            
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );                                                                  
            curl_setopt( $ch,CURLOPT_POST, true );  
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);                                                                  
                                                                                                                                 
            $result = curl_exec($ch);
$j->status  = "101";
$j->message = $langs == 'en' ? "Success" : "تم";
$j->data=$profiledata;

}
else{
$j->status  = "104";
$j->message = $langs == 'en' ? "Email And Password wrong" : "خطأ في كلمة المرور او البريد الالكتروني"; 

}
}
else{
$j->status  = "103";
$j->message = $langs == 'en' ? "Your Account Not Approved" : "حسابك غير مفعل بعد"; 

}
echo json_encode($j);         
?>
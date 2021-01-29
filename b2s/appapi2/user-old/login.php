<?php
include '../../config.php';
include 'fcm-message.php';
 
$os=$_POST['os'];
if($os == 'android'){ 
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $password=base64_encode($pass); 
    $fcmtoken=$_POST['fcmToken'];
}else{
    $arrdata=array();
    $data = json_decode(file_get_contents("php://input")); 
    $email=$data->email;
    $pass=$data->password;
    $password=base64_encode($pass); 
    $fcmtoken=$data->fcmtoken;
}
 
$resultdata =$con->query("select * from `users` where email='$email' AND password='$password'");
 

$data=array();
$id=0;
while($row = mysqli_fetch_array($resultdata)){
     
    $id=$row['id'];
}
if($id > 0)
{ 
    
$insert = $con->query("UPDATE `users` SET `fcmToken`='$fcmtoken',`loginAt`=NOW() WHERE  id='$id'");

$resultdata =$con->query("select * from `users` where id='$id' "); 
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
$j->message = "Success";
$j->data=$profiledata;

}
else{
$j->status  = "104";
$j->message = "Email And Password wrong"; 

}
echo json_encode($j);         
?>
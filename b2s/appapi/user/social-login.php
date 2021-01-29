<?php
include '../../config.php';

 
$fcmtoken=$_POST['fcmToken'];
 
$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$type=$_POST['login_type'];
$pass='123456';
$password=base64_decode($pass);

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
    $data=$row;
  
}      
    //   $data = array("to" => $fcmtoken,
    //               "notification" => array( "code"=> $logincodefcm,"title" => "$titlefcm", "body" => $loginmsg,"icon" => $logofcm));                                                                    
    //         $data_string = json_encode($data); 
            
    //          "The Json Data : ".$data_string; 
            
    //         $headers = array
    //         (
    //              'Authorization: key=' . API_ACCESS_KEY, 
    //              'Content-Type: application/json'
    //         );                                                                                 
                                                                                                                                 
    //         $ch = curl_init();  
            
    //         curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );                                                                  
    //         curl_setopt( $ch,CURLOPT_POST, true );  
    //         curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    //         curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    //         curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);                                                                  
                                                                                                                                 
    //         $result = curl_exec($ch);
$j->status  = "101";
$j->message = $langs == 'en' ? "Success" : "تم";
$j->data=$data;

}
else{
$insert = $con->query("INSERT INTO `users`(`name`, `email`, `password`, `phone`,`login_type`) VALUES
                                       ('$name','$email','$password','$phone','$type')");

                if($insert > 0)
                { 
               
                $resultdata =$con->query("select * from `users` order by id desc LIMIT 1 "); 
                while($row = mysqli_fetch_array($resultdata)){
                    $data=$row;
                  
                } 
                 $j->status  = "101";
                 $j->message = $langs == 'en' ? "Success" : "تم"; 
                 $j->data=$data;
                }
                else{
                $j->status  = "104";
                $j->message = $langs == 'en' ? "Some thing wrong" : "حدث خطأ"; 
                
                } 

}
echo json_encode($j);         
?>
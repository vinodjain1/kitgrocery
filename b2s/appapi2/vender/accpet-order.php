<?php
include '../../config.php';
include './fcm-message.php';



$os=$_POST['os'];
if($os == 'android'){ 
    $userid=$_POST['userid'];
    $orderid=$_POST['orderid'];
    $status=$_POST['status'];
}else{
    $arrdata=array();
    $data = json_decode(file_get_contents("php://input"));  
    $userid=$data->userid;
    $orderid=$data->orderid; 
    $status=$data->status;
}



  $update = $con->query("UPDATE `tbl_order` SET `status`='$status',`vender_id`='$userid' WHERE id='$orderid'");
 

    
if($update > 0)
{ 
    /////////////////////////////////fcm//////////////////////
    $resultdatatbl_order =$con->query("select * from `tbl_order` where id='$orderid'");
    while($rowtbl_order = mysqli_fetch_array($resultdatatbl_order)){
        $orderuserid=$rowtbl_order['user_id'];
    }
    $new_status = str_replace(".''."," ",$status);
    $title= $accpetoredrtitle.' '.$new_status;
    
    $description=$accpetoredrbody.' '.$status.' '.$accpetoredrbody1;
    //echo $description;
    //exit();
    $insert = $con->query("INSERT INTO `tbl_notification`( `title_ar`, `description_ar`, `title_en`, `description_en`, `order_id`, `user_id`, `vendor_id`, `create_at`, `update_at`) VALUES 
                                         ('$title','$description','$title','$description','$orderid','$orderuserid','$userid',NOW(),NOW())");

      $resultdata =$con->query("select * from `users` where id=$orderuserid");
    while($row = mysqli_fetch_array($resultdata))
            {
                    $fcmtoken=$row['fcmToken'];
            
        
            
                    $data = array("to" => $fcmtoken,
                          "notification" => array( "title" => "$accpetoredrtitle $status", "body" => $accpetoredrbody.' '.$status.' '.$accpetoredrbody1,"icon" => $icon),
                            "data"=>array("code"=> $accpetoredrcode, "key1"=> $orderid,"key2"=> $status )
                          );                                                                    
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
                    /////////////////////////////////fcm//////////////////////
            }
                 $j->status  = "101";
                 $j->message = $langs == 'en' ? "Success" : "تم"; 
                }
                else{
                $j->status  = "104";
                
                $j->message = $langs == 'en' ? "Some thing wrong" : "حدث خطأ";
                /*if($_POST['lang'] == "en"){
                    $j->message = "Some thing wrong"; 
                }else{
                    $j->message = "arabic";
                }*/
                
                }

echo json_encode($j);


?>